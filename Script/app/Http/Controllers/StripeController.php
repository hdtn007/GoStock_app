<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Models\Images;
use App\Models\Deposits;
use App\Models\User;
use App\Models\Plans;
use App\Helper;
use Mail;
use Carbon\Carbon;
use App\Models\PaymentGateways;

class StripeController extends Controller
{
  use Traits\FunctionsTrait;

  public function __construct( AdminSettings $settings, Request $request) {
    $this->settings = $settings::first();
    $this->request = $request;
  }

  public function show()
  {
    return response()->json([
      'success' => true,
      'insertBody' => '<i></i>'
    ]);
  }// End Show

  // Add Funds to wallet
  public function charge()
  {
    // Get Payment Gateway
    $payment = PaymentGateways::whereId($this->request->payment_gateway)->whereName('Stripe')->firstOrFail();

    //<---- Validation
		$validator = Validator::make($this->request->all(), [
      'amount' => 'required|integer|min:'.$this->settings->min_deposits_amount.'|max:'.$this->settings->max_deposits_amount,
      'payment_gateway' => 'required'
    ]);

			if ($validator->fails()) {
			        return response()->json([
					        'success' => false,
					        'errors' => $validator->getMessageBag()->toArray(),
					    ]);
			    }

    $email = auth()->user()->email;

  	$feeStripe   = $payment->fee;
  	$centsStripe =  $payment->fee_cents;

    $taxes = ($this->request->amount * auth()->user()->isTaxable()->sum('percentage') / 100);

    if ($this->settings->currency_code == 'JPY') {
      $amountFixed = round($this->request->amount + ($this->request->amount * $feeStripe / 100) + $centsStripe + $taxes);
    } else {
      $amountFixed = number_format($this->request->amount + ($this->request->amount * $feeStripe / 100) + $centsStripe + $taxes, 2, '.', ',');
    }

  	$amountGross = ($this->request->amount);
  	$amount   = $this->settings->currency_code == 'JPY' ? $amountFixed : ($amountFixed*100);
  	$currency_code = $this->settings->currency_code;
  	$description = trans('misc.add_funds_desc');
  	$nameSite = $this->settings->title;

    \Stripe\Stripe::setApiKey($payment->key_secret);

    $intent = null;
    try {
      if (isset($this->request->payment_method_id)) {
        # Create the PaymentIntent
        $intent = \Stripe\PaymentIntent::create([
          'payment_method' => $this->request->payment_method_id,
          'amount' => $amount,
          'currency' => $currency_code,
          "description" => $description,
          'confirmation_method' => 'manual',
          'confirm' => true
        ]);
      }
      if (isset($this->request->payment_intent_id)) {
        $intent = \Stripe\PaymentIntent::retrieve(
          $this->request->payment_intent_id
        );
        $intent->confirm();
      }
      return $this->generatePaymentResponse($intent);
    } catch (\Stripe\Exception\ApiErrorException $e) {
      # Display error on client
      return response()->json([
        'error' => $e->getMessage()
      ]);
    }
  }// End charge

  protected function generatePaymentResponse($intent) {
    # Note that if your API version is before 2019-02-11, 'requires_action'
    # appears as 'requires_source_action'.
    if ($intent->status == 'requires_action' &&
        $intent->next_action->type == 'use_stripe_sdk') {
      # Tell the client to handle the action
      return response()->json([
        'requires_action' => true,
        'payment_intent_client_secret' => $intent->client_secret,
      ]);
    } else if ($intent->status == 'succeeded') {
      # The payment didn’t need any additional actions and completed!
      # Handle post-payment fulfillment

      // Insert Deposit
      $this->deposit(
        auth()->user()->id,
        $intent->id,
        $this->request->amount,
        'Stripe',
        auth()->user()->taxesPayable()
      );

      // Add Funds to User
      auth()->user()->increment('funds', $this->request->amount);

      return response()->json([
        "success" => true
      ]);
    } else {
      # Invalid status
      http_response_code(500);
      return response()->json(['error' => 'Invalid PaymentIntent status']);
    }
  }// End generatePaymentResponse

  // Process Purchase
  public function processBuy()
  {
    // Get Payment Gateway
    $payment = PaymentGateways::whereId($this->request->payment_gateway)->whereName('Stripe')->firstOrFail();

    // Get Image
    $image = Images::where('token_id', $this->request->token)->firstOrFail();

    //<---- Validation
		$validator = Validator::make($this->request->all(), [
      'payment_gateway' => 'required'
    ]);

		if ($validator->fails()) {
		        return response()->json([
				        'success' => false,
				        'errors' => $validator->getMessageBag()->toArray(),
				    ]);
		    }

    $itemPrice = $this->priceItem($this->request->license, $image->price, $this->request->type);

  	$amount   = $this->settings->currency_code == 'JPY' ? Helper::amountGross($itemPrice) : (Helper::amountGross($itemPrice)*100);
  	$currency_code = $this->settings->currency_code;
  	$description = trans('misc.stock_photo_purchase');

    \Stripe\Stripe::setApiKey($payment->key_secret);

    $intent = null;
    try {
      if (isset($this->request->payment_method_id)) {
        # Create the PaymentIntent
        $intent = \Stripe\PaymentIntent::create([
          'payment_method' => $this->request->payment_method_id,
          'amount' => $amount,
          'currency' => $currency_code,
          "description" => $description,
          'confirmation_method' => 'manual',
          'confirm' => true
        ]);
      }
      if (isset($this->request->payment_intent_id)) {
        $intent = \Stripe\PaymentIntent::retrieve(
          $this->request->payment_intent_id
        );
        $intent->confirm();
      }
      return $this->generateBuyResponse($intent);
    } catch (\Stripe\Exception\ApiErrorException $e) {
      # Display error on client
      return response()->json([
        'error' => $e->getMessage()
      ]);
    }
  }// end method processBuy

  protected function generateBuyResponse($intent) {
    # Note that if your API version is before 2019-02-11, 'requires_action'
    # appears as 'requires_source_action'.
    if ($intent->status == 'requires_action' &&
        $intent->next_action->type == 'use_stripe_sdk') {
      # Tell the client to handle the action
      return response()->json([
        'requires_action' => true,
        'payment_intent_client_secret' => $intent->client_secret,
      ]);
    } else if ($intent->status == 'succeeded') {
      # The payment didn’t need any additional actions and completed!
      # Handle post-payment fulfillment

      //========== Processor Fees
      $payment = PaymentGateways::whereName('Stripe')->first();

      // Get Image
      $image = Images::where('token_id', $this->request->token)->firstOrFail();

      // Price Item
      $itemPrice = $this->priceItem($this->request->license, $image->price, $this->request->type);

      // Admin and user earnings calculation
      $earnings = $this->earningsAdminUser($image->user()->author_exclusive, $itemPrice, $payment->fee, $payment->fee_cents);

      // Stripe Connect
      if ($image->user()->stripe_connect_id && $image->user()->completed_stripe_onboarding) {
        try {
          // Stripe Client
          $stripe = new \Stripe\StripeClient($payment->key_secret);

          $earningsUser = $this->settings->currency_code == 'JPY' ? $earnings['user'] : ($earnings['user']*100);

          $stripe->transfers->create([
            'amount' => $earningsUser,
            'currency' => $this->settings->currency_code,
            'destination' => $image->user()->stripe_connect_id,
            'description' => trans('misc.stock_photo_purchase')
          ]);

          $directPayment = true;

        } catch (\Exception $e) {
          \Log::info($e->getMessage());
        }
      }

      // Insert purchase
      $this->purchase(
        $intent->id,
        $image,
        auth()->id(),
        $itemPrice,
        $earnings['user'],
        $earnings['admin'],
        $this->request->type,
        $this->request->license,
        $earnings['percentageApplied'],
        'Stripe',
        auth()->user()->taxesPayable(),
        $directPayment ?? false
      );

      return response()->json([
        "success" => true,
        'url' => url('user/dashboard/purchases')
      ]);

    } else {
      # Invalid status
      http_response_code(500);
      return response()->json(['error' => 'Invalid PaymentIntent status']);
    }
  }// End generatePaymentResponse

  public function subscription()
  {
    if (! $this->request->expectsJson()) {
        abort(404);
    }

    $plan = Plans::wherePlanId($this->request->plan)->whereStatus('1')->firstOrFail();

    // Check Subscription
    if (auth()->user()->getSubscription()) {
      return response()->json([
          'success' => false,
          'errors' => ['error' => trans('misc.subscription_exists')],
      ]);
    }

    $payment = PaymentGateways::whereName('Stripe')->whereEnabled(1)->first();
    $stripe = new \Stripe\StripeClient($payment->key_secret);
    $planId = $plan->plan_id;
    $planPrice = $this->request->interval == 'month' ? $plan->price : $plan->price_year;

    // Verify Plan Exists
    try {
      $planCurrent = $stripe->plans->retrieve($planId, []);
      $pricePlanOnStripe = ($planCurrent->amount / 100);

      // We check if the plan changed price
      if ($pricePlanOnStripe != $planPrice) {
        // Delete old plan
        $stripe->plans->delete($planId, []);

        // Delete Product
        $stripe->products->delete($planCurrent->product, []);

        // We create the plan with new price
        $this->createPlan($payment->key_secret, $plan, $this->request->interval);
      }

    } catch (\Exception $exception) {

      // Create New Plan
      $this->createPlan($payment->key_secret, $plan, $this->request->interval);
    }

      try {

        // Create New subscription
        $metadata = [
          'interval' => $this->request->interval,
          'taxes' => auth()->user()->taxesPayable()
        ];

        $checkout = auth()->user()->newSubscription('main', $planId)
        ->withMetadata($metadata)
          ->checkout([
            'success_url' => route('success.subscription', ['alert' => 'payment']),
            'cancel_url' => url('pricing'),
        ]);

        return response()->json([
          'success' => true,
          'url' => $checkout->url,
        ]);

      } catch (\Exception $exception) {

        \Log::debug($exception);

        return response()->json([
          'success' => false,
          'errors' => ['error' => $exception->getMessage()]
        ]);
    }
  }

  private function createPlan($keySecret, $plan, $interval)
  {
    $stripe = new \Stripe\StripeClient($keySecret);

    switch ($interval) {
      case 'month':
        $interval = 'month';
        $interval_count = 1;
        $price = $plan->price;
        break;

      case 'year':
        $interval = 'year';
        $interval_count = 1;
        $price = $plan->price_year;
        break;
    }

    // If it does not exist we create the plan
    $stripe->plans->create([
        'currency' => $this->settings->currency_code,
        'interval' => $interval,
        'interval_count' => $interval_count,
        "product" => [
            "name" => trans('misc.subscription_plan', ['name' => $plan->name]),
        ],
        'nickname' => $plan->name,
        'id' => $plan->plan_id,
        'amount' => $this->settings->currency_code == 'JPY' ? $price : ($price * 100),
    ]);
  }

}
