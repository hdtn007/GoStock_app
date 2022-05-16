<div class="py-5 py-footer-large bg-dark-2 text-light">
      <footer class="container">
        <div class="row">

          <div class="col-md-3">
            <a href="<?php echo e(url('/'), false); ?>">
              <img src="<?php echo e(url('public/img', $settings->logo_light), false); ?>" width="150">
            </a>
            <span class="w-100 d-block mb-2"><?php echo e(__('misc.desc_footer_social'), false); ?></span>

            <ul class="list-inline list-social">

				<?php if($settings->twitter != ''): ?>
				<li class="list-inline-item"><a href="<?php echo e($settings->twitter, false); ?>" target="_blank" class="ico-social"><i class="fab fa-twitter"></i></a></li>
				<?php endif; ?>

				<?php if($settings->facebook != ''): ?>
				<li class="list-inline-item"><a href="<?php echo e($settings->facebook, false); ?>" target="_blank" class="ico-social"><i class="fab fa-facebook"></i></a></li>
				<?php endif; ?>

				<?php if($settings->instagram != ''): ?>
				<li class="list-inline-item"><a href="<?php echo e($settings->instagram, false); ?>" target="_blank" class="ico-social"><i class="fab fa-instagram"></i></a></li>
				<?php endif; ?>

				<?php if($settings->linkedin != ''): ?>
				<li class="list-inline-item"><a href="<?php echo e($settings->linkedin, false); ?>" target="_blank" class="ico-social"><i class="fab fa-linkedin"></i></a></li>
				<?php endif; ?>

				<?php if($settings->youtube != ''): ?>
				<li class="list-inline-item"><a href="<?php echo e($settings->youtube, false); ?>" target="_blank" class="ico-social"><i class="fab fa-youtube"></i></a></li>
				<?php endif; ?>

				<?php if($settings->pinterest != ''): ?>
				<li class="list-inline-item"><a href="<?php echo e($settings->pinterest, false); ?>" target="_blank" class="ico-social"><i class="fab fa-pinterest"></i></a></li>
				<?php endif; ?>
            </ul>
          </div>

          <div class="col-md-3">
            <h5><?php echo e(trans('misc.about'), false); ?></h5>
            <ul class="list-unstyled">
					<?php $__currentLoopData = Helper::pages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><a class="text-white text-decoration-none" href="<?php echo e(url('page', $page->slug), false); ?>"><?php echo e($page->title, false); ?></a></li>
					  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					  <li><a class="text-white text-decoration-none" href="<?php echo e(url('contact'), false); ?>"><?php echo e(trans('misc.contact'), false); ?></a></li>

            </li></ul>
          </div>

          <div class="col-md-3">
            <h5><?php echo e(trans('misc.categories'), false); ?></h5>
            <ul class="list-unstyled">
			<?php $__currentLoopData = Categories::where('mode','on')->orderBy('name')->take(6)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
				<a class="text-white text-decoration-none" href="<?php echo e(url('category', $category->slug), false); ?>">
                <?php echo e(Lang::has('categories.' . $category->slug) ? __('categories.' . $category->slug) : $category->name, false); ?>

              </a>
			  </li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			<?php if(Categories::count() > 6): ?>
			 <li><a class="text-white text-decoration-none arrow" href="<?php echo e(url('categories'), false); ?>"><?php echo e(trans('misc.view_all'), false); ?></a></li>
			<?php endif; ?>

			</ul>
          </div>

          <div class="col-md-3">
            <h5><?php echo e(trans('misc.links'), false); ?></h5>
            <ul class="list-unstyled">

          <?php if($settings->sell_option == 'on'): ?>
          <li>
    			  <a class="text-white text-decoration-none" href="<?php echo e(url('photos/premium'), false); ?>"><?php echo e(trans('misc.premium'), false); ?></a>
    			</li>
          <?php endif; ?>

          <li>
    			  <a class="text-white text-decoration-none" href="<?php echo e(url('featured'), false); ?>"><?php echo e(trans('misc.featured'), false); ?></a>
    			</li>

          <li>
    			  <a class="text-white text-decoration-none" href="<?php echo e(url('collections'), false); ?>"><?php echo e(trans('misc.collections'), false); ?></a>
    			</li>

			  <?php if(auth()->guard()->guest()): ?>
			<li>
			  <a class="text-white text-decoration-none" href="<?php echo e(url('login'), false); ?>"><?php echo e(trans('auth.login'), false); ?></a>
			  </li>

			  <?php if($settings->registration_active == 1): ?>
				<li>
				<a class="text-white text-decoration-none" href="<?php echo e(url('register'), false); ?>"><?php echo e(trans('auth.sign_up'), false); ?></a>
				</li>
			  <?php endif; ?>

			  <?php else: ?>

			  <?php if(auth()->user()->role): ?>
				<li>
				<a class="text-white text-decoration-none" href="<?php echo e(url('panel/admin'), false); ?>"><?php echo e(trans('admin.admin'), false); ?></a>
				</li>
			  <?php endif; ?>

			  <li>
				<a class="text-white text-decoration-none" href="<?php echo e(url(auth()->user()->username), false); ?>"><?php echo e(trans('users.my_profile'), false); ?></a>
				</li>

				<li>
				<a class="text-white text-decoration-none" href="<?php echo e(url('logout'), false); ?>"><?php echo e(trans('users.logout'), false); ?></a>
				</li>

			  <?php endif; ?>


				<li class="dropdown">
                  <a class="btn btn-outline-light rounded-pill mt-2 dropdown-toggle px-4" id="dropdownLang" href="javascript:;" data-bs-toggle="dropdown">
                        <i class="fa fa-globe me-1"></i>

				  <?php $__currentLoopData = Languages::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    	<?php if($languages->abbreviation == config('app.locale')): ?> <?php echo e($languages->name, false); ?>

						<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</a>

                    <div class="dropdown-menu dropdown-menu-macos">



					<?php $__currentLoopData = Languages::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    	<?php if( $languages->abbreviation == config('app.locale')): ?>

						<a class="dropdown-item dropdown-lang <?php if($languages->abbreviation == config('app.locale')): ?> active  <?php endif; ?>" aria-labelledby="dropdownLang">


						 <?php if($languages->abbreviation == config('app.locale')): ?>
						 <i class="bi bi-check2 me-1"></i>
						 <?php endif; ?>

							<?php echo e($languages->name, false); ?>

						<?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </a>
					 </div>
				</li>
      </ul>
    </div>
  </div>
</footer>
</div>

      <footer class="py-2 bg-dark-3 text-muted">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              &copy;<?php echo e($settings->title, false); ?> - <?php echo date('Y'); ?>
            </div>
            </div>
        </div>
      </footer>
<?php /**PATH C:\xampp\htdocs\demo\gostock\_gostock\Script\resources\views/includes/footer.blade.php ENDPATH**/ ?>