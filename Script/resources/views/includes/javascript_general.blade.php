<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('public/js/core.min.js') }}?v={{$settings->version}}"></script>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/fleximages/jquery.flex-images.min.js') }}"></script>
<script src="{{ asset('public/js/timeago/jqueryTimeago_'.Lang::locale().'.js') }}"></script>
<script src="{{ asset('public/js/functions.js') }}?v={{$settings->version}}"></script>

<script src="https://js.stripe.com/v3/"></script>
<script src='https://js.paystack.co/v1/inline.js'></script>
<script src='https://checkout.razorpay.com/v1/checkout.js'></script>

<script type="text/javascript">

@if (session('required_2fa'))
var myModal = new bootstrap.Modal(document.getElementById('modal2fa'), {
  backdrop: 'static',
  keyboard: false
});
myModal.show();
@endif
</script>
