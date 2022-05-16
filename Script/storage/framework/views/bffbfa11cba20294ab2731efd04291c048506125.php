<!-- Bootstrap core CSS -->
<link href="<?php echo e(asset('public/css/core.min.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/css/bootstrap.min.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/css/bootstrap-icons.css'), false); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/js/fleximages/jquery.flex-images.css'), false); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/css/styles.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet">

<script type="text/javascript">
    var URL_BASE = "<?php echo e(url('/'), false); ?>";
    var lang = '<?php echo e(session('locale'), false); ?>';
    var _title = '<?php $__env->startSection("title"); ?><?php echo $__env->yieldSection(); ?> <?php echo e(e($settings->title), false); ?>';
    var session_status = "<?php echo e(auth()->check() ? 'on' : 'off', false); ?>";
    var colorStripe = '#000000';
    var copiedSuccess = "<?php echo e(trans('misc.copied_success'), false); ?>";
    var error = "<?php echo e(trans('misc.error'), false); ?>";
    var resending_code = "<?php echo e(trans('misc.resending_code'), false); ?>";
    var isProfile = <?php echo e(request()->route()->named('profile') ? 'true' : 'false', false); ?>;
    var download = '<?php echo e(trans('misc.download'), false); ?>';
    var downloading = '<?php echo e(trans('misc.downloading'), false); ?>';

    <?php if(auth()->guard()->check()): ?>
      var stripeKey = "<?php echo e(PaymentGateways::where('id', 2)->where('enabled', '1')->first() ? env('STRIPE_KEY') : false, false); ?>";
      var delete_confirm = "<?php echo e(trans('misc.delete_confirm'), false); ?>";
      var confirm_delete = "<?php echo e(__('misc.yes'), false); ?>";
      var cancel_confirm = "<?php echo e(__('misc.no'), false); ?>";
      var your_subscribed = "<?php echo e(trans('misc.your_subscribed'), false); ?>";
    <?php endif; ?>
 </script>

<style>
 .home-cover { background-image: url('<?php echo e(url('public/img', $settings->image_header), false); ?>') }
 :root {
   --color-default: <?php echo e($settings->color_default, false); ?> !important;
   --bg-auth: url('<?php echo e(url('public/img', $settings->image_header), false); ?>');
 }
 </style>
<?php /**PATH C:\xampp\htdocs\demo\gostock\_gostock\Script\resources\views/includes/css_general.blade.php ENDPATH**/ ?>