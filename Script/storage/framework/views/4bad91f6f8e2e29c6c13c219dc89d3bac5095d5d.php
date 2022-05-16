<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-3 mb-3">
        <a href="<?php echo e(url('category', $category->slug), false); ?>" class="item-category position-relative d-block" title="<?php echo e($category->name, false); ?>">
          <img class="img-fluid rounded" src="<?php echo e($category->thumbnail ? url('public/img-category', $category->thumbnail) : asset('public/img-category/default.jpg'), false); ?>" alt="<?php echo e($category->name, false); ?>">
          <h5 class="text-truncate px-3"><?php echo e($category->name, false); ?></h5>
        </a>
      </div><!-- col-3-->
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\demo\gostock\_gostock\Script\resources\views/includes/categories-listing.blade.php ENDPATH**/ ?>