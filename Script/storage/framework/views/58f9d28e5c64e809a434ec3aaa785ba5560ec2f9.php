<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo e(asset('public/js/core.min.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
<script src="<?php echo e(asset('public/js/bootstrap.min.js'), false); ?>"></script>
<script src="<?php echo e(asset('public/js/fleximages/jquery.flex-images.min.js'), false); ?>"></script>
<script src="<?php echo e(asset('public/js/timeago/jqueryTimeago_'.Lang::locale().'.js'), false); ?>"></script>
<script src="<?php echo e(asset('public/js/functions.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>

<script src="https://js.stripe.com/v3/"></script>
<script src='https://js.paystack.co/v1/inline.js'></script>
<script src='https://checkout.razorpay.com/v1/checkout.js'></script>

<script type="text/javascript">

<?php if(session('required_2fa')): ?>
var myModal = new bootstrap.Modal(document.getElementById('modal2fa'), {
  backdrop: 'static',
  keyboard: false
});
myModal.show();
<?php endif; ?>
</script>
<?php /**PATH C:\xampp\htdocs\demo\gostock\_gostock\Script\resources\views/includes/javascript_general.blade.php ENDPATH**/ ?>