<header class="py-3 shadow-sm fixed-top bg-white" id="header">
        <div class="container-fluid d-grid gap-3 px-4 align-items-center" style="grid-template-columns: 0fr 2fr;">

            <a href="<?php echo e(url('/'), false); ?>" class="d-flex align-items-center col-lg-4 link-dark text-decoration-none fw-bold display-6">
              <img src="<?php echo e(url('public/img', $settings->logo), false); ?>" class="logo d-none d-lg-block" width="110" />
              <img src="<?php echo e(url('public/img', $settings->favicon), false); ?>" class="logo d-block d-lg-none" height="32" />
            </a>

          <div class="d-flex align-items-center">

            <form action="<?php echo e(url('search'), false); ?>" method="get" class="w-100 me-3 position-relative">
              <i class="bi bi-search btn-search bar-search"></i>
              <input type="text" class="form-control rounded-pill ps-5 input-search search-navbar" name="q" autocomplete="off" placeholder="<?php echo e(trans('misc.search'), false); ?>" required minlength="3">
            </form>

            <!-- Start Nav -->
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 navbar-session">

              <?php if(Plans::whereStatus('1')->count() != 0): ?>
                <li><a href="<?php echo e(url('pricing'), false); ?>" class="nav-link px-2 link-dark"><?php echo e(trans('misc.pricing'), false); ?></a></li>
              <?php endif; ?>


              <?php if(auth()->guard()->check()): ?>
                <li><a href="<?php echo e(url('feed'), false); ?>" class="nav-link px-2 link-dark"><?php echo e(trans('misc.feed'), false); ?></a></li>
              <?php endif; ?>

              <li class="dropdown">
                <a href="javascript:void(0);" class="nav-link px-2 link-dark dropdown-toggle" id="dropdownExplore" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo e(trans('misc.explore'), false); ?>

              </a>
              <ul class="dropdown-menu dropdown-menu-macos dropdown-menu-lg-end arrow-dm" aria-labelledby="dropdownExplore">
                <li><a class="dropdown-item" href="<?php echo e(url('members'), false); ?>"><i class="bi bi-people me-2"></i> <?php echo e(trans('misc.members'), false); ?></a></li>
                <li><a class="dropdown-item" href="<?php echo e(url('collections'), false); ?>"><i class="bi bi-plus-square me-2"></i> <?php echo e(trans('misc.collections'), false); ?></a></li>

                <?php if($settings->sell_option == 'on'): ?>
                <li><a class="dropdown-item" href="<?php echo e(url('photos/premium'), false); ?>"><i class="fa fa-crown me-2 text-warning"></i> <?php echo e(trans('misc.premium'), false); ?></a></li>
                <?php endif; ?>

                <li><hr class="dropdown-divider"></li>

                <li><a class="dropdown-item" href="<?php echo e(url('featured'), false); ?>"><?php echo e(trans('misc.featured'), false); ?></a></li>
                <li><a class="dropdown-item" href="<?php echo e(url('popular'), false); ?>"><?php echo e(trans('misc.popular'), false); ?></a></li>
                <li><a class="dropdown-item" href="<?php echo e(url('latest'), false); ?>"><?php echo e(trans('misc.latest'), false); ?></a></li>
                <li><a class="dropdown-item" href="<?php echo e(url('most/commented'), false); ?>"><?php echo e(trans('misc.most_commented'), false); ?></a></li>
                <li><a class="dropdown-item" href="<?php echo e(url('most/viewed'), false); ?>"><?php echo e(trans('misc.most_viewed'), false); ?></a></li>
                <li><a class="dropdown-item" href="<?php echo e(url('most/downloads'), false); ?>"><?php echo e(trans('misc.most_downloads'), false); ?></a></li>
              </ul>
              </li>

              <li class="dropdown">
                <a href="javascript:void(0);" class="nav-link px-2 link-dark dropdown-toggle" id="dropdownExplore" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo e(trans('misc.categories'), false); ?>

                </a>
                <ul class="dropdown-menu dropdown-menu-macos dropdown-menu-lg-end arrow-dm" aria-labelledby="dropdownCategories">

                <?php $__currentLoopData = Categories::whereMode('on')->orderBy('name')->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li>
                  <a class="dropdown-item" href="<?php echo e(url('category', $category->slug), false); ?>">
                  <?php echo e(Lang::has('categories.' . $category->slug) ? __('categories.' . $category->slug) : $category->name, false); ?>

                    </a>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  <?php if(Categories::count() > 5): ?>
                  <li>
                    <a class="dropdown-item arrow" href="<?php echo e(url('categories'), false); ?>">
                      <strong><?php echo e(trans('misc.view_all'), false); ?></strong>
                      </a>
                    </li>
                    <?php endif; ?>
                </ul>
              </li>

              <?php if(auth()->guard()->check()): ?>
              <li class="position-relative">
              <span class="noti_notifications notify <?php if(auth()->user()->unseenNotifications()): ?> d-block <?php else: ?> display-none <?php endif; ?>">
              <?php echo e(auth()->user()->unseenNotifications(), false); ?>

              </span>

              <a href="<?php echo e(url('notifications'), false); ?>" class="nav-link px-2 link-dark"><i class="bi bi-bell me-2"></i></a>
              </li>

              <?php if(auth()->user()->authorized_to_upload == 'yes'): ?>
              <li>
                <a href="<?php echo e(url('upload'), false); ?>" class="btn btn-custom me-4 animate-up-2 d-none d-lg-block" title="<?php echo e(trans('users.upload'), false); ?>">
                  <strong><?php echo e(trans('users.upload'), false); ?></strong>
                </a>
              </li>
              <?php endif; ?>

              <?php endif; ?>

            </ul><!-- End Nav -->

                <?php if(auth()->guard()->check()): ?>
                <div class="position-relative">

                <span class="noti_notifications notify notify-mobile d-lg-none <?php if(auth()->user()->unseenNotifications()): ?> d-block <?php else: ?> display-none <?php endif; ?>">
                <?php echo e(auth()->user()->unseenNotifications(), false); ?>

                </span>

                <!-- Bell notification on mobile -->
                <a href="<?php echo e(url('notifications'), false); ?>" class="text-decoration-none text-muted noty d-block d-lg-none">
                  <i class="bi bi-bell me-2"></i>
                </a>
                </div>
                <?php endif; ?>

                <?php if(auth()->guard()->guest()): ?>
                  <a class="btn btn-custom ms-2 animate-up-2 d-none d-lg-block" href="<?php echo e(url('login'), false); ?>">
                  <strong><?php echo e(trans('auth.login'), false); ?></strong>
                  </a>
                <?php endif; ?>


            <?php if(auth()->guard()->check()): ?>
            <div class="flex-shrink-0 dropdown">

              <a href="javascript:void(0);" class="d-block link-dark text-decoration-none" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo e(Storage::url(config('path.avatar').auth()->user()->avatar), false); ?>" width="32" height="32" class="rounded-circle avatarUser">
              </a>
              <ul class="dropdown-menu dropdown-menu-macos arrow-dm" aria-labelledby="dropdownUser2">
                <?php echo $__env->make('includes.menu-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </ul>

            </div>
            <?php endif; ?>

            <a class="ms-3 toggle-menu d-block d-lg-none text-dark fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" href="#">
            <i class="bi-list"></i>
            </a>

          </div><!-- d-flex -->
        </div><!-- container-fluid -->
      </header>

    <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
        <span class="offcanvas-title" id="offcanvas">
          <img src="<?php echo e(url('public/img', $settings->logo), false); ?>" class="logo" width="100" />
        </span>
        <button type="button" class="btn-close text-reset close-menu-mobile" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">

          <?php if(Plans::whereStatus('1')->count() != 0): ?>
            <li>
              <a href="<?php echo e(url('pricing'), false); ?>" class="nav-link link-dark text-truncate">
              <?php echo e(trans('misc.pricing'), false); ?>

            </a>
          </li>
          <?php endif; ?>

          <?php if(auth()->guard()->check()): ?>
            <li>
            <a href="<?php echo e(url('feed'), false); ?>" class="nav-link link-dark text-truncate">
              <?php echo e(trans('misc.feed'), false); ?>

            </a>
            </li>
          <?php endif; ?>

            <li>
                <a href="#explore" data-bs-toggle="collapse" class="nav-link text-truncate link-dark dropdown-toggle">
                    <?php echo e(trans('misc.explore'), false); ?>

                  </a>
            </li>

            <div class="collapse ps-3" id="explore">

              <li><a class="nav-link text-truncate text-muted" href="<?php echo e(url('members'), false); ?>"><i class="bi bi-people me-2"></i> <?php echo e(trans('misc.members'), false); ?></a></li>
              <li><a class="nav-link text-truncate text-muted" href="<?php echo e(url('collections'), false); ?>"><i class="bi bi-plus-square me-2"></i> <?php echo e(trans('misc.collections'), false); ?></a></li>

              <?php if($settings->sell_option == 'on'): ?>
              <li><a class="nav-link text-truncate text-muted" href="<?php echo e(url('photos/premium'), false); ?>"><i class="fa fa-crown me-2 text-warning"></i> <?php echo e(trans('misc.premium'), false); ?></a></li>
              <?php endif; ?>

              <li><a class="nav-link text-truncate text-muted" href="<?php echo e(url('featured'), false); ?>"><?php echo e(trans('misc.featured'), false); ?></a></li>
              <li><a class="nav-link text-truncate text-muted" href="<?php echo e(url('popular'), false); ?>"><?php echo e(trans('misc.popular'), false); ?></a></li>
              <li><a class="nav-link text-truncate text-muted" href="<?php echo e(url('latest'), false); ?>"><?php echo e(trans('misc.latest'), false); ?></a></li>
              <li><a class="nav-link text-truncate text-muted" href="<?php echo e(url('most/commented'), false); ?>"><?php echo e(trans('misc.most_commented'), false); ?></a></li>
              <li><a class="nav-link text-truncate text-muted" href="<?php echo e(url('most/viewed'), false); ?>"><?php echo e(trans('misc.most_viewed'), false); ?></a></li>
              <li><a class="nav-link text-truncate text-muted" href="<?php echo e(url('most/downloads'), false); ?>"><?php echo e(trans('misc.most_downloads'), false); ?></a></li>
            </div>

            <li>
                <a href="#categories" data-bs-toggle="collapse" class="nav-link text-truncate link-dark dropdown-toggle">
                    <?php echo e(trans('misc.categories'), false); ?>

                  </a>
            </li>

            <div class="collapse ps-3" id="categories">
              <?php $__currentLoopData = Categories::whereMode('on')->orderBy('name')->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                <a class="nav-link text-truncate text-muted" href="<?php echo e(url('category', $category->slug), false); ?>">
                <?php echo e(Lang::has('categories.' . $category->slug) ? __('categories.' . $category->slug) : $category->name, false); ?>

                  </a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(Categories::count() > 5): ?>
                <li>
                  <a class="nav-link text-truncate text-muted arrow" href="<?php echo e(url('categories'), false); ?>">
                    <strong><?php echo e(trans('misc.view_all'), false); ?></strong>
                    </a>
                  </li>
                  <?php endif; ?>
            </div>

            <?php if(auth()->check() && auth()->user()->authorized_to_upload == 'yes'): ?>
            <li class="p-3 w-100">
              <a href="<?php echo e(url('upload'), false); ?>" class="btn btn-custom d-block w-100 animate-up-2" title="<?php echo e(trans('users.upload'), false); ?>">
                <strong><?php echo e(trans('users.upload'), false); ?></strong>
              </a>
            </li>
          <?php endif; ?>

          <?php if(auth()->guard()->guest()): ?>
            <li class="p-3 w-100">
              <a href="<?php echo e(url('login'), false); ?>" class="btn btn-custom d-block w-100 animate-up-2" title="<?php echo e(trans('auth.login'), false); ?>">
                <strong><?php echo e(trans('auth.login'), false); ?></strong>
              </a>
            </li>
          <?php endif; ?>


        </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\demo\gostock\_gostock\Script\resources\views/includes/navbar.blade.php ENDPATH**/ ?>