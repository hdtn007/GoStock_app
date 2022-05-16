<?php if(auth()->user()->role && ! request()->is('panel/admin') && ! request()->is('panel/admin/*')): ?>
  <li><a class="dropdown-item" href="<?php echo e(url('panel/admin'), false); ?>"><i class="bi bi-speedometer2 me-2"></i> <?php echo e(trans('admin.admin'), false); ?></a></li>
  <li><hr class="dropdown-divider"></li>
<?php endif; ?>

<?php if($settings->sell_option == 'on'): ?>
<li><span class="dropdown-item disable-item"><i class="bi bi-cash-stack me-2"></i> <?php echo e(trans('misc.balance'), false); ?>: <?php echo e(Helper::amountFormatDecimal(auth()->user()->balance), false); ?></span></li>
<?php endif; ?>

<li><a class="dropdown-item" href="<?php echo e(url('user/dashboard/add/funds'), false); ?>"><i class="bi bi-wallet2 me-2"></i> <?php echo e(trans('misc.wallet'), false); ?>: <?php echo e(Helper::amountFormatDecimal(auth()->user()->funds), false); ?></a></li>

<?php if($settings->daily_limit_downloads != 0 && auth()->user()->role != 'admin'): ?>
    <li>
        <span class="dropdown-item disable-item">
        <i class="bi bi-download me-2"></i> <?php echo e(trans('misc.downloads'), false); ?>: <?php echo e(auth()->user()->freeDailyDownloads(), false); ?>/<?php echo e($settings->daily_limit_downloads, false); ?>

    </span>
    </li>
<?php endif; ?>

<li>
<a class="dropdown-item" href="<?php echo e(url('user/dashboard'), false); ?>">
    <i class="bi bi-speedometer2 me-2"></i> <?php echo e(trans('admin.dashboard'), false); ?>

    </a>
</li>

<li>
<a class="dropdown-item" href="<?php echo e(url(auth()->user()->username), false); ?>">
    <i class="bi bi-person me-2"></i> <?php echo e(trans('users.my_profile'), false); ?>

    </a>
</li>

<li>
<a class="dropdown-item" href="<?php echo e(url('account/subscription'), false); ?>">
    <i class="bi-arrow-repeat me-2"></i> <?php echo e(trans('misc.subscription'), false); ?>

    </a>
</li>

<li>
<a class="dropdown-item" href="<?php echo e(url('user/dashboard/purchases'), false); ?>">
    <i class="bi-bag-check me-2"></i> <?php echo e(trans('misc.my_purchases'), false); ?>

    </a>
</li>

<li>
<a class="dropdown-item" href="<?php echo e(url(auth()->user()->username, 'collections'), false); ?>">
    <i class="bi bi-plus-square me-2"></i> <?php echo e(trans('misc.collections'), false); ?>

    </a>
</li>

<li>
<a class="dropdown-item" href="<?php echo e(url('likes'), false); ?>">
    <i class="bi bi-heart me-2"></i> <?php echo e(trans('users.likes'), false); ?>

    </a>
</li>

<?php if($settings->referral_system == 'on'): ?>
<li>
<a class="dropdown-item" href="<?php echo e(url('my/referrals'), false); ?>">
    <i class="bi-person-plus me-2"></i> <?php echo e(trans('misc.referrals'), false); ?>

    </a>
</li>
<?php endif; ?>

<li>
<a class="dropdown-item" href="<?php echo e(url('account'), false); ?>">
    <i class="bi bi-gear me-2"></i> <?php echo e(trans('users.account_settings'), false); ?>

    </a>
</li>

<li><hr class="dropdown-divider"></li>
<li>
  <a class="dropdown-item" href="<?php echo e(url('logout'), false); ?>">
    <i class="bi bi-box-arrow-in-right me-2"></i> <?php echo e(trans('users.logout'), false); ?></a>
  </li>
<?php /**PATH C:\xampp\htdocs\demo\gostock\_gostock\Script\resources\views/includes/menu-dropdown.blade.php ENDPATH**/ ?>