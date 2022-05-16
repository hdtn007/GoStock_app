<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale()), false); ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
    <meta name="description" content="<?php echo $__env->yieldContent('description_custom'); ?><?php echo e(__('seo.description'), false); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords_custom'); ?><?php echo e(__('seo.keywords'), false); ?>" />
    <link rel="shortcut icon" href="<?php echo e(url('public/img', $settings->favicon), false); ?>" />

    <title><?php if(auth()->guard()->check()): ?> <?php echo e(auth()->user()->unseenNotifications() ? '('.auth()->user()->unseenNotifications().') ' : null, false); ?> <?php endif; ?> <?php $__env->startSection('title'); ?><?php echo $__env->yieldSection(); ?> <?php echo e($settings->title, false); ?></title>

    <?php echo $__env->make('includes.css_general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php $config = (new \LaravelPWA\Services\ManifestService)->generate(); echo $__env->make( 'laravelpwa::meta' , ['config' => $config])->render(); ?>

    <?php echo $__env->yieldContent('css'); ?>

    <?php if($settings->google_analytics != ''): ?>
      <?php echo $settings->google_analytics; ?>

    <?php endif; ?>
  </head>
  <body>
    <div class="overlay" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></div>
  <div class="popout font-default"></div>

  <div class="wrap-loader">
  <div class="progress-wrapper display-none position-absolute w-100" id="progress">
    <div class="progress progress-container">
      <div class="progress-bar progress-bg" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
    </div>
    <div class="wrap-container">
      <div class="progress-info">
        <div class="progress-percentage">
          <span class="percent">0%</span>
        </div>
      </div>
    </div>

  </div>
  </div>

  <div class="fixed-bottom">
    <div class="d-flex justify-content-center align-items-center">
      <div class="text-center display-none showBanner shadow-sm mb-3 mx-2">
        <?php echo e(trans('misc.cookies_text'), false); ?>


        <button class="btn btn-sm btn-dark ms-1" id="close-banner">
          <?php echo e(trans('misc.go_it'), false); ?>

        </button>
      </div>
    </div>
  </div>


    <main>
      <?php if(! request()->is('login')
          && ! request()->is('register')
          && ! request()->is('password/*')
          ): ?>
      <?php echo $__env->make('includes.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>

    <?php if(! request()->is('login')
        && ! request()->is('register')
        && ! request()->is('password/*')
        ): ?>
      <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    </main>

    <?php echo $__env->make('includes.javascript_general', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('javascript'); ?>

     <div id="bodyContainer"></div>
     </body>
</html>
<?php /**PATH C:\xampp\htdocs\demo\gostock\_gostock\Script\resources\views/layouts/app.blade.php ENDPATH**/ ?>