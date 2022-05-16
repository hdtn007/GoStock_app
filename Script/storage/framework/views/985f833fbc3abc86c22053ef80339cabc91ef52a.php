<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale()), false); ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
    <link rel="shortcut icon" href="<?php echo e(url('public/img', $settings->favicon), false); ?>" />

    <title><?php echo e(__('admin.admin'), false); ?></title>

    <link href="<?php echo e(asset('public/css/core.min.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/bootstrap.min.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/bootstrap-icons.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/admin-styles.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/styles.css'), false); ?>?v=<?php echo e($settings->version, false); ?>" rel="stylesheet">

    <script type="text/javascript">
        var URL_BASE = "<?php echo e(url('/'), false); ?>";
        var error = "<?php echo e(trans('misc.error'), false); ?>";
        var delete_confirm = "<?php echo e(trans('misc.delete_confirm'), false); ?>";
        var yes_confirm = "<?php echo e(trans('misc.yes_confirm'), false); ?>";
        var yes = "<?php echo e(trans('misc.yes'), false); ?>";
        var cancel_confirm = "<?php echo e(trans('misc.cancel_confirm'), false); ?>";
        var timezone = "<?php echo e(env('TIMEZONE'), false); ?>";
     </script>

    <style>
     :root {
       --color-default: <?php echo e($settings->color_default, false); ?> !important;
     }
     </style>

    <?php echo $__env->yieldContent('css'); ?>
  </head>
  <body>
  <div class="overlay" data-bs-toggle="offcanvas" data-bs-target="#sidebar-nav"></div>
  <div class="popout font-default"></div>

    <main>

      <div class="offcanvas offcanvas-start sidebar bg-dark text-white" tabindex="-1" id="sidebar-nav" data-bs-keyboard="false" data-bs-backdrop="false">
      <div class="offcanvas-header">
          <h5 class="offcanvas-title"><img src="<?php echo e(url('public/img', $settings->logo_light), false); ?>" width="100" /></h5>
          <button type="button" class="btn-close btn-close-custom text-white toggle-menu d-lg-none" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
      </div>
      <div class="offcanvas-body px-0 scrollbar">
          <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start list-sidebar" id="menu">

              <?php if(auth()->user()->hasPermission('dashboard')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin')): ?> active <?php endif; ?>">
                      <i class="bi-speedometer2 me-2"></i> <?php echo e(__('admin.dashboard'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

              <?php if(auth()->user()->hasPermission('general_settings')): ?>
              <li class="nav-item">
                  <a href="#settings" data-bs-toggle="collapse" class="nav-link text-truncate dropdown-toggle <?php if(request()->is('panel/admin/settings') ||request()->is('panel/admin/settings/limits')): ?> active <?php endif; ?>" <?php if(request()->is('panel/admin/settings') ||request()->is('panel/admin/settings/limits')): ?> aria-expanded="true" <?php endif; ?>>
                      <i class="bi-gear me-2"></i> <?php echo e(__('admin.general_settings'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

              <div class="collapse <?php if(request()->is('panel/admin/settings') || request()->is('panel/admin/settings/limits')): ?> show <?php endif; ?> ps-3" id="settings">
                <li>
                <a class="nav-link text-truncate" href="<?php echo e(url('panel/admin/settings'), false); ?>">
                  <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(trans('admin.general'), false); ?>

                  </a>
                </li>
                <li>
                <a class="nav-link text-truncate" href="<?php echo e(url('panel/admin/settings/limits'), false); ?>">
                  <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(trans('admin.limits'), false); ?>

                  </a>
                </li>
              </div><!-- /end collapse settings -->

              <?php if(auth()->user()->hasPermission('maintenance_mode')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/maintenance'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/maintenance')): ?> active <?php endif; ?>">
                      <i class="bi bi-tools me-2"></i> <?php echo e(__('admin.maintenance_mode'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

            <?php if(auth()->user()->hasPermission('billing_information')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/billing'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/billing')): ?> active <?php endif; ?>">
                      <i class="bi-receipt-cutoff me-2"></i> <?php echo e(__('admin.billing_information'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

              <?php if(auth()->user()->hasPermission('purchases')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/purchases'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/purchases')): ?> active <?php endif; ?>">
                      <i class="bi-cart2 me-2"></i> <?php echo e(__('admin.purchases'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

                <?php if(auth()->user()->hasPermission('tax_rates')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/tax-rates'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/tax-rates')): ?> active <?php endif; ?>">
                      <i class="bi-receipt me-2"></i> <?php echo e(__('admin.tax_rates'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

            <?php if(auth()->user()->hasPermission('plans')): ?>
            <li class="nav-item">
                <a href="<?php echo e(url('panel/admin/plans'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/plans')): ?> active <?php endif; ?>">
                    <i class="bi-box2 me-2"></i> <?php echo e(__('admin.plans'), false); ?>

                </a>
            </li><!-- /end list -->
            <?php endif; ?>

            <?php if(auth()->user()->hasPermission('subscriptions')): ?>
            <li class="nav-item">
                <a href="<?php echo e(url('panel/admin/subscriptions'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/subscriptions')): ?> active <?php endif; ?>">
                    <i class="bi-arrow-repeat me-2"></i> <?php echo e(__('admin.subscriptions'), false); ?>

                </a>
            </li><!-- /end list -->
            <?php endif; ?>

            <?php if(auth()->user()->hasPermission('countries')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/countries'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/countries')): ?> active <?php endif; ?>">
                      <i class="bi-globe me-2"></i> <?php echo e(__('admin.countries'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('states')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/states'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/states')): ?> active <?php endif; ?>">
                      <i class="bi-pin-map me-2"></i> <?php echo e(__('admin.states'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('email_settings')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/settings/email'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/settings/email')): ?> active <?php endif; ?>">
                      <i class="bi-at me-2"></i> <?php echo e(__('admin.email_settings'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('storage')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/storage'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/storage')): ?> active <?php endif; ?>">
                      <i class="bi-server me-2"></i> <?php echo e(__('admin.storage'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php $__currentLoopData = Addons::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(auth()->user()->hasPermission($addon->name)): ?>
                  <li class="nav-item">
                      <a href="<?php echo e(url('panel/admin', $addon->slug), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/'.$addon->slug.'')): ?> active <?php endif; ?>">
                          <i class="<?php echo e($addon->icon, false); ?> me-2"></i> <?php echo e(__('admin.'.$addon->name), false); ?>

                      </a>
                  </li><!-- /end list -->
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <?php if(auth()->user()->hasPermission('theme')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/theme'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/theme')): ?> active <?php endif; ?>">
                      <i class="bi-brush me-2"></i> <?php echo e(__('admin.theme'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('images')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/images'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/images')): ?> active <?php endif; ?>">
                      <i class="bi-image me-2"></i>

                      <?php if(Images::whereStatus('pending')->count() <> 0): ?>
                        <i class="bi-circle-fill small text-warning alert-admin"></i>
                      <?php endif; ?>
                       <?php echo e(__('admin.images'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('languages')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/languages'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/languages')): ?> active <?php endif; ?>">
                      <i class="bi-translate me-2"></i> <?php echo e(__('admin.languages'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('deposits')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/deposits'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/deposits')): ?> active <?php endif; ?>">
                      <i class="bi-cash-stack me-2"></i> <?php echo e(__('admin.deposits'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('withdrawals')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/withdrawals'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/withdrawals')): ?> active <?php endif; ?>">
                      <i class="bi-bank me-2"></i>

                      <?php if(Withdrawals::whereStatus('pending')->count() <> 0): ?>
                        <i class="bi-circle-fill small text-warning alert-admin"></i>
                      <?php endif; ?>

                      <?php echo e(__('admin.withdrawals'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('categories')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/categories'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/categories')): ?> active <?php endif; ?>">
                      <i class="bi-list-stars me-2"></i> <?php echo e(__('admin.categories'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('members')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/members'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/members')): ?> active <?php endif; ?>">
                      <i class="bi-people me-2"></i> <?php echo e(__('admin.members'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('role_and_permissions')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/roles-and-permissions'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/roles-and-permissions')): ?> active <?php endif; ?>">
                      <i class="bi-person-badge me-2"></i> <?php echo e(__('admin.role_and_permissions'), false); ?>

                  </a>
              </li><!-- /end list -->
            <?php endif; ?>

            <?php if(auth()->user()->hasPermission('members_reported')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/members-reported'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/members-reported')): ?> active <?php endif; ?>">
                      <i class="bi-person-x me-2"></i>

                      <?php if(UsersReported::count() <> 0): ?>
                        <i class="bi-circle-fill small text-warning alert-admin"></i>
                      <?php endif; ?>

                      <?php echo e(__('admin.members_reported'), false); ?>

                  </a>
              </li><!-- /end list -->
                <?php endif; ?>

              <?php if(auth()->user()->hasPermission('images_reported')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/images-reported'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/images-reported')): ?> active <?php endif; ?>">
                      <i class="bi-flag me-2"></i>

                      <?php if(ImagesReported::count() <> 0): ?>
                        <i class="bi-circle-fill small text-warning alert-admin"></i>
                      <?php endif; ?>

                      <?php echo e(__('admin.images_reported'), false); ?>

                  </a>
              </li><!-- /end list -->
                <?php endif; ?>

              <?php if(auth()->user()->hasPermission('pages')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/pages'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/pages')): ?> active <?php endif; ?>">
                      <i class="bi-file-earmark-text me-2"></i> <?php echo e(__('admin.pages'), false); ?>

                  </a>
              </li><!-- /end list -->
                <?php endif; ?>

                <?php if(auth()->user()->hasPermission('payment_settings')): ?>
              <li class="nav-item">
                  <a href="#payments" data-bs-toggle="collapse" class="nav-link text-truncate dropdown-toggle <?php if(request()->is('panel/admin/payments') || request()->is('panel/admin/payments/*')): ?> active <?php endif; ?>" <?php if(request()->is('panel/admin/payments') || request()->is('panel/admin/payments/*')): ?> aria-expanded="true" <?php endif; ?>>
                      <i class="bi-credit-card me-2"></i> <?php echo e(__('admin.payment_settings'), false); ?>

                  </a>
              </li><!-- /end list -->

              <div class="collapse ps-3 <?php if(request()->is('panel/admin/payments') || request()->is('panel/admin/payments/*')): ?> show <?php endif; ?>" id="payments">
                <li>
                <a class="nav-link text-truncate" href="<?php echo e(url('panel/admin/payments'), false); ?>">
                  <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e(trans('admin.general'), false); ?>

                  </a>
                </li>

                <?php $__currentLoopData = PaymentGateways::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                <a class="nav-link text-truncate" href="<?php echo e(url('panel/admin/payments', $key->id), false); ?>">
                  <i class="bi-chevron-right fs-7 me-1"></i> <?php echo e($key->name, false); ?>

                  </a>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div><!-- /end collapse settings -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('profiles_social')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/profiles-social'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/profiles-social')): ?> active <?php endif; ?>">
                      <i class="bi-share me-2"></i> <?php echo e(__('admin.profiles_social'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('social_login')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/social-login'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/social-login')): ?> active <?php endif; ?>">
                      <i class="bi-facebook me-2"></i> <?php echo e(__('admin.social_login'), false); ?>

                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('google')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/google'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/google')): ?> active <?php endif; ?>">
                      <i class="bi-google me-2"></i> Google
                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

              <?php if(auth()->user()->hasPermission('pwa')): ?>
              <li class="nav-item">
                  <a href="<?php echo e(url('panel/admin/pwa'), false); ?>" class="nav-link text-truncate <?php if(request()->is('panel/admin/pwa')): ?> active <?php endif; ?>">
                      <i class="bi-phone me-2"></i> PWA
                  </a>
              </li><!-- /end list -->
              <?php endif; ?>

          </ul>
      </div>
  </div>

  <header class="py-3 mb-3 shadow-custom bg-white">

    <div class="container-fluid d-grid gap-3 px-4 justify-content-end position-relative">

      <div class="d-flex align-items-center">

        <a class="text-dark ms-2 animate-up-2 me-4" href="<?php echo e(url('/'), false); ?>">
        <?php echo e(trans('admin.view_site'), false); ?> <i class="bi-arrow-up-right"></i>
        </a>

        <div class="flex-shrink-0 dropdown">
          <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
           <img src="<?php echo e(Storage::url(config('path.avatar').auth()->user()->avatar), false); ?>" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-macos arrow-dm" aria-labelledby="dropdownUser2">
            <?php echo $__env->make('includes.menu-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </ul>
        </div>

        <a class="ms-3 toggle-menu d-block d-lg-none text-dark fs-3 position-absolute start-0" data-bs-toggle="offcanvas" data-bs-target="#sidebar-nav" href="#">
            <i class="bi-list"></i>
            </a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
      <div class="row">
          <div class="col min-vh-100 admin-container p-4">
              <?php echo $__env->yieldContent('content'); ?>
          </div>
      </div>
  </div>

  <footer class="admin-footer px-4 py-3 bg-white shadow-custom">
    &copy; <?php echo e($settings->title, false); ?> v<?php echo e($settings->version, false); ?> - <?php echo e(date('Y'), false); ?>

  </footer>

</main>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo e(asset('public/js/core.min.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>
    <script src="<?php echo e(asset('public/js/bootstrap.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('public/js/ckeditor/ckeditor.js'), false); ?>"></script>
    <script src="<?php echo e(asset('public/js/select2/select2.full.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('public/js/admin-functions.js'), false); ?>?v=<?php echo e($settings->version, false); ?>"></script>

    <?php echo $__env->yieldContent('javascript'); ?>

    <?php if(session('unauthorized')): ?>
      <script type="text/javascript">
       swal({
         title: "<?php echo e(trans('misc.error_oops'), false); ?>",
         text: "<?php echo e(session('unauthorized'), false); ?>",
         type: "error",
         confirmButtonText: "<?php echo e(trans('users.ok'), false); ?>"
         });
         </script>
      <?php endif; ?>
     </body>
</html>
<?php /**PATH C:\xampp\htdocs\demo\gostock\_gostock\Script\resources\views/admin/layout.blade.php ENDPATH**/ ?>