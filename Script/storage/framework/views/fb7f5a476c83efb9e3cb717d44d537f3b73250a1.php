<?php $__env->startSection('content'); ?>
<div class="container-fluid home-cover">
      <div class="mb-4 position-relative custom-pt-6">
        <div class="container px-5">
          <h1 class="display-3 fw-bold text-white"><?php echo e(__('seo.welcome_text'), false); ?></h1>
          <p class="col-md-8 fs-4 fw-bold text-white"><?php echo e(__('seo.welcome_subtitle'), false); ?></p>
          <form action="<?php echo e(url('search'), false); ?>" method="get" class="position-relative">
            <i class="bi bi-search btn-search"></i>
            <input class="form-control form-control-lg ps-5 input-search-lg border-0 search-lg" type="text" name="q" autocomplete="off" placeholder="<?php echo e(trans('misc.search'), false); ?>" required minlength="3">
          </form>

		  <?php if($categoryPopular): ?>
          <p class="mt-2 text-white linkCategoryPopular">
            <?php echo e(trans('misc.popular_categories'), false); ?> <?php echo $categoryPopular; ?>

          </p>
		  <?php endif; ?>

        </div>
      </div>
    </div><!-- container-fluid -->


<div class="container py-5 py-large">

	<?php if($images->total() != 0): ?>

    <div class="btn-block text-center mb-5">
      <?php if($settings->show_images_index == 'latest'): ?>
      <h3 class="m-0"><?php echo e(trans('misc.recent_photos'), false); ?></h3>
      <p>
        <?php echo e(trans('misc.latest_desc'), false); ?>

      </p>
    <?php endif; ?>

    <?php if($settings->show_images_index == 'featured'): ?>
    <h3 class="m-0"><?php echo e(trans('misc.featured_photos'), false); ?></h3>
    <p>
      <?php echo e(trans('misc.featured_desc'), false); ?>

    </p>
  <?php endif; ?>

    </div>

    <?php echo $__env->make('includes.images', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="w-100 d-block text-center mt-5">
      <a href="<?php echo e($settings->show_images_index == 'latest' ? url('latest') : url('featured'), false); ?>" class="btn btn-lg btn-main rounded-pill btn-outline-custom px-4 arrow px-5">
        <?php echo e(trans('misc.view_all'), false); ?>

      </a>
    </div>

	<?php else: ?>
	<h4 class="text-center">
      <div class="d-block w-100 display-2">
        <i class="bi bi-images"></i>
      </div>

		<?php echo e(trans('misc.no_images_published'), false); ?>

	</h4>

  <div class="w-100 d-block text-center mt-3">
    <a href="<?php echo e(url('upload'), false); ?>" class="btn btn-lg btn-main rounded-pill btn-outline-custom px-4 arrow px-5">
      <?php echo e(trans('users.upload'), false); ?>

    </a>
  </div>
	<?php endif; ?>

  <?php if($settings->google_adsense && $settings->google_ads_index == 'on' && $settings->google_adsense_index != ''): ?>
    <div class="col-md-12 mt-3">
      <?php echo $settings->google_adsense_index; ?>

    </div>
  <?php endif; ?>
</div><!-- container photos -->

    <?php if($images->total() != 0): ?>
    <section class="section py-5 py-large bg-light">
      <div class="container">
        <div class="row align-items-center">
        <div class="col-12 col-lg-7 text-center mb-3 px-5">
          <img src="<?php echo e(url('public/img', $settings->img_section), false); ?>" class="img-fluid">
        </div>
        <div class="col-12 col-lg-5 text-lg-start text-center">
          <h1 class="m-0 card-profile"><?php echo e(trans('misc.title_section_home'), false); ?></h1>
          <div class="col-12 p-0">
            <p class="py-4 m-0 text-muted"><?php echo e(trans('misc.desc_section_home'), false); ?></p>
          </div>
          <a href="<?php echo e(url('latest'), false); ?>" class="btn btn-lg btn-main rounded-pill btn-outline-custom  px-4 arrow">
            <?php echo e(trans('misc.explore'), false); ?>

          </a>
        </div>
      </div>
      </div>
    </section>
    <?php endif; ?>

    <?php if($settings->show_counter == 'on'): ?>
    <section class="section py-2 bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="d-flex py-3 my-1 my-lg-0 justify-content-center">
              <span class="me-3 display-4"><i class="bi bi-people align-baseline"></i></span>
              <div>
                <h3 class="mb-0"><span class="counter"><?php echo e(User::whereStatus('active')->count(), false); ?></span></h3>
                <h5><?php echo e(trans('misc.members'), false); ?></h5>
              </div>
            </div>

          </div>
          <div class="col-md-4">
            <div class="d-flex py-3 my-1 my-lg-0 justify-content-center">
              <span class="me-3 display-4"><i class="bi bi-download align-baseline"></i></span>
              <div>
                <h3 class="mb-0"><span class="counter"><?php echo e(Downloads::count(), false); ?></span></h3>
                <h5 class="font-weight-light"><?php echo e(trans('misc.downloads'), false); ?></h5>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex py-3 my-1 my-lg-0 justify-content-center">
              <span class="me-3 display-4"><i class="bi bi-images align-baseline"></i></span>
              <div>
                <h3 class="mb-0"> <span class="counterStats"><?php echo e(Images::whereStatus('active')->count(), false); ?></span></h3>
                <h5 class="font-weight-light"><?php echo e(trans('misc.stock_photos'), false); ?></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

	<?php if($settings->show_categories_index == 'on'): ?>
    <section class="section py-5 py-large">
      <div class="container">
        <div class="btn-block text-center mb-5">
          <h3 class="m-0"><?php echo e(trans('misc.categories'), false); ?></h3>
          <p>
            <?php echo e(trans('misc.browse_by_category'), false); ?>

          </p>
        </div>

        <div class="row">

		<?php echo $__env->make('includes.categories-listing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($categories->total() > 4): ?>
    <div class="w-100 d-block text-center mt-4">
      <a href="<?php echo e(url('categories'), false); ?>" class="btn btn-lg btn-main rounded-pill btn-outline-custom px-4 arrow px-5">
        <?php echo e(trans('misc.view_all'), false); ?>

      </a>
    </div>
    <?php endif; ?>

</section>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script type="text/javascript">

  $('#imagesFlex').flexImages({ rowHeight: 320, maxRows: 8, truncate: true });

		<?php if(session('success_verify')): ?>
		swal({
			title: "<?php echo e(trans('misc.welcome'), false); ?>",
			text: "<?php echo e(trans('users.account_validated'), false); ?>",
			type: "success",
			confirmButtonText: "<?php echo e(trans('users.ok'), false); ?>"
			});
		<?php endif; ?>

		<?php if(session('error_verify')): ?>
		swal({
			title: "<?php echo e(trans('misc.error_oops'), false); ?>",
			text: "<?php echo e(trans('users.code_not_valid'), false); ?>",
			type: "error",
			confirmButtonText: "<?php echo e(trans('users.ok'), false); ?>"
			});
		<?php endif; ?>

	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\gostock\_gostock\Script\resources\views/index/home.blade.php ENDPATH**/ ?>