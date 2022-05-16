//<--------- Start Payment -------//>
(function($) {
	"use strict";

	$('input[name=payment_gateway]').on('click', function() {

		$('#payButton').removeAttr('disabled');

    if ($(this).val() == 2) {
      $('#stripeContainer').slideDown();
    } else {
      $('#stripeContainer').slideUp();
    }
  });

 //<---------------- Pay  ----------->>>>
 if (stripeKey != '') {

 // Create a Stripe client.
 var stripe = Stripe(stripeKey);

 // Create an instance of Elements.
 var elements = stripe.elements();

 // Custom styling can be passed to options when creating an Element.
 // (Note that this demo uses a wider set of styles than the guide below.)
 var style = {
	 base: {
		 color: colorStripe,
		 fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
		 fontSmoothing: 'antialiased',
		 fontSize: '16px',
		 '::placeholder': {
			 color: '#aab7c4'
		 }
	 },
	 invalid: {
		 color: '#fa755a',
		 iconColor: '#fa755a'
	 }
 };

 // Create an instance of the card Element.
 var cardElement = elements.create('card', {style: style, hidePostalCode: true});

 // Add an instance of the card Element into the `card-element` <div>.
 cardElement.mount('#card-element');

 // Handle real-time validation errors from the card Element.
 cardElement.addEventListener('change', function(event) {
	 var displayError = document.getElementById('card-errors');
	 var payment = $('input[name=payment_gateway]:checked').val();

	 if (payment == 2) {
		 if (event.error) {
			 displayError.classList.remove('display-none');
			 displayError.textContent = event.error.message;
			 $('#payButton').removeAttr('disabled');
			 $('#payButton').find('i').removeClass('spinner-border spinner-border-sm align-middle me-1');
		 } else {
			 displayError.classList.add('display-none');
			 displayError.textContent = '';
		 }
	 }

 });

 var cardholderName = document.getElementById('cardholder-name');
 var cardholderEmail = document.getElementById('cardholder-email');
 var cardButton = document.getElementById('payButton');

 cardButton.addEventListener('click', function(ev) {

	 var payment = $('input[name=payment_gateway]:checked').val();

	 if (payment == 2) {

	 stripe.createPaymentMethod('card', cardElement, {
		 billing_details: {name: cardholderName.value, email: cardholderEmail.value}
	 }).then(function(result) {
		 if (result.error) {

			 if (result.error.type == 'invalid_request_error') {

					 if(result.error.code == 'parameter_invalid_empty') {
						 $('.popout').addClass('popout-error').html(error).fadeIn('500').delay('8000').fadeOut('500');
					 } else {
						 $('.popout').addClass('popout-error').html(result.error.message).fadeIn('500').delay('8000').fadeOut('500');
					 }
			 }
			 $('#payButton').removeAttr('disabled');
			 $('#payButton').find('i').removeClass('spinner-border spinner-border-sm align-middle me-1');

		 } else {

			 $('#payButton').attr({'disabled' : 'true'});
			 $('#payButton').find('i').addClass('spinner-border spinner-border-sm align-middle me-1');

			 // Otherwise send paymentMethod.id to your server
			 $('input[name=payment_method_id]').remove();

			 var $input = $('<input id=payment_method_id type=hidden name=payment_method_id />').val(result.paymentMethod.id);
			 $('#formSendBuy').append($input);

			 $.ajax({
			 headers: {
					 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				 },
				type: "POST",
				dataType: 'json',
				url: URL_BASE+"/payment/stripe/buy/charge",
				data: $('#formSendBuy').serialize(),
				success: function(result) {
						handleServerResponse(result);

						if (result.success == false) {
							$('#payButton').removeAttr('disabled');
							$('#payButton').find('i').removeClass('spinner-border spinner-border-sm align-middle me-1');
						}
			}//<-- RESULT
			})

		 }//ELSE
	 });
 }//PAYMENT STRIPE
});

 function handleServerResponse(response) {
	 if (response.error) {
		 $('.popout').addClass('popout-error').html(response.error).fadeIn('500').delay('8000').fadeOut('500');
		 $('#payButton').removeAttr('disabled');
		 $('#payButton').find('i').removeClass('spinner-border spinner-border-sm align-middle me-1');

	 } else if (response.requires_action) {
		 // Use Stripe.js to handle required card action
		 stripe.handleCardAction(
			 response.payment_intent_client_secret
		 ).then(function(result) {
			 if (result.error) {
				 $('.popout').addClass('popout-error').html(error_payment_stripe_3d).fadeIn('500').delay('10000').fadeOut('500');
				 $('#payButton').removeAttr('disabled');
				 $('#payButton').find('i').removeClass('spinner-border spinner-border-sm align-middle me-1');

			 } else {
				 // The card action has been handled
				 // The PaymentIntent can be confirmed again on the server

				 var $input = $('<input type=hidden name=payment_intent_id />').val(result.paymentIntent.id);
				 $('#formSendBuy').append($input);

				 $('input[name=payment_method_id]').remove();

				 $.ajax({
				 headers: {
						 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					 },
					type: "POST",
					dataType: 'json',
					url: URL_BASE+"/payment/stripe/buy/charge",
					data: $('#formSendBuy').serialize(),
					success: function(result) {

						if (result.success) {
							window.location.href = result.url;

						} else {
							$('.popout').addClass('popout-error').html(result.error).fadeIn('500').delay('8000').fadeOut('500');
							$('#payButton').removeAttr('disabled');
							$('#payButton').find('i').removeClass('spinner-border spinner-border-sm align-middle me-1');
						}
				}//<-- RESULT
				})
			 }// ELSE
		 });
	 } else {
		 // Show success message
		 if (response.success) {
			 window.location.href = response.url;
		 }
	 }
 }
}
// Stripe Elements

//<---------------- Pay ----------->>>>
 $(document).on('click','#payButton',function(s) {

	 s.preventDefault();
	 var element = $(this);
	 var form = $(this).attr('data-form');
	 element.attr({'disabled' : 'true'});
	 var payment = $('input[name=payment_gateway]:checked').val();
	 element.find('i').addClass('spinner-border spinner-border-sm align-middle me-1');

	 (function(){
			$('#formSendBuy').ajaxForm({
			dataType : 'json',
			success:  function(result) {

				if (result.success && result.insertBody) {

					$('#bodyContainer').html('');

				 $(result.insertBody).appendTo("#bodyContainer");

				 if (payment != 1 && payment != 2) {
					 element.removeAttr('disabled');
					 element.find('i').removeClass('spinner-border spinner-border-sm align-middle me-1');
				 }

					$('#errorPurchase').hide();

				} else if (result.success && result.url) {
					window.location.href = result.url;
				} else {

					if (result.errors) {

						var error = '';
						var $key = '';

						for ($key in result.errors) {
							error += '<li><i class="far fa-times-circle me-1"></i> ' + result.errors[$key] + '</li>';
						}

						$('#showErrorsPurchase').html(error);
						$('#errorPurchase').show();
						element.removeAttr('disabled');
						element.find('i').removeClass('spinner-border spinner-border-sm align-middle me-1');
					}
				}

			 },
			 error: function(responseText, statusText, xhr, $form) {
					 // error
					 element.removeAttr('disabled');
					 element.find('i').removeClass('spinner-border spinner-border-sm align-middle me-1');
					 $('.popout').addClass('popout-error').html(error+' ('+xhr+')').fadeIn('500').delay('8000').fadeOut('500');
			 }
		 }).submit();
	 })(); //<--- FUNCTION %
 });//<<<-------- * END FUNCTION CLICK * ---->>>>
//============ End Payment =================//

$('#checkout').on('hidden.bs.modal', function (e) {
  $('#errorPurchase, #stripeContainer').hide();
	$('#formSendBuy').trigger("reset");
	$('#card-errors').addClass('display-none');
	$('.InputElement').val('');
	$('#card-element').removeClass('StripeElement--invalid');
	$('#payButton').attr({'disabled' : 'true'});
});

})(jQuery);
