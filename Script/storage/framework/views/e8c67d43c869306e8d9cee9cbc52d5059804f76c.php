

<?php $__env->startSection('content'); ?>
	<h4 class="mb-4 fw-light"><?php echo e(__('admin.dashboard'), false); ?> <small class="fs-6">v<?php echo e($settings->version, false); ?></small></h4>

<div class="content">
	<div class="row">

		<div class="col-lg-3 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h3>
						<i class="fa fa-shopping-cart me-2 icon-dashboard"></i>
						<span><?php echo e(number_format($totalSales), false); ?></span>
					</h3>
					<small><?php echo e(trans('misc.total_sales'), false); ?></small>

					<span class="icon-wrap icon--admin"><i class="bi bi-cart2"></i></span>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-3 -->

		<div class="col-lg-3 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h3><i class="fas fa-hand-holding-usd me-2 icon-dashboard"></i> <?php echo e(Helper::amountFormatDecimal($earningNetAdmin), false); ?></h3>
					<small><?php echo e(trans('misc.total_earnings'), false); ?></small>

					<span class="icon-wrap icon--admin"><i class="bi bi-cash-stack"></i></span>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-3 -->

		<div class="col-lg-3 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h3><i class="fa fa-users me-2 icon-dashboard"></i> <?php echo e($totalUsers, false); ?></h3>
					<small><?php echo e(trans('admin.members'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi bi-people"></i></span>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-3 -->

		<div class="col-lg-3 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h3><i class="fa fa-images me-2 icon-dashboard"></i> <?php echo e(number_format($totalImages), false); ?></h3>
					<small><?php echo e(trans('misc.images'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="far fa-images"></i></span>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-3 -->



		<div class="col-lg-4 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h6 class="<?php echo e($stat_revenue_today > 0 ? 'text-success' : 'text-danger', false); ?>">
						<?php echo e(Helper::amountFormatDecimal($stat_revenue_today), false); ?>


							<?php echo Helper::PercentageIncreaseDecrease($stat_revenue_today, $stat_revenue_yesterday); ?>

					</h6>
					<small><?php echo e(trans('misc.revenue_today'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi bi-graph-up-arrow"></i></span>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-4 -->

		<div class="col-lg-4 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h6 class="<?php echo e($stat_revenue_week > 0 ? 'text-success' : 'text-danger', false); ?>">
						<?php echo e(Helper::amountFormatDecimal($stat_revenue_week), false); ?>


							<?php echo Helper::PercentageIncreaseDecrease($stat_revenue_week, $stat_revenue_last_week); ?>

					</h6>
					<small><?php echo e(trans('misc.revenue_week'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi bi-graph-up"></i></span>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-4 -->

		<div class="col-lg-4 mb-3">
			<div class="card shadow-custom border-0 overflow-hidden">
				<div class="card-body">
					<h6 class="<?php echo e($stat_revenue_month > 0 ? 'text-success' : 'text-danger', false); ?>">
						<?php echo e(Helper::amountFormatDecimal($stat_revenue_month), false); ?>


							<?php echo Helper::PercentageIncreaseDecrease($stat_revenue_month, $stat_revenue_last_month); ?>

					</h6>
					<small><?php echo e(trans('misc.revenue_month'), false); ?></small>
					<span class="icon-wrap icon--admin"><i class="bi bi-graph-up-arrow"></i></span>
				</div>
			</div><!-- card 1 -->
		</div><!-- col-lg-4 -->

		<div class="col-lg-6 mt-3 py-4">
			 <div class="card shadow-custom border-0">
				 <div class="card-body">
					 <h6 class="mb-4 fw-light"><?php echo e(trans('misc.earnings_raised_last'), false); ?></h6>
					 <div style="height: 350px">
						<canvas id="Chart"></canvas>
					</div>
				 </div>
			 </div>
		</div>

		<div class="col-lg-6 mt-0 mt-lg-3 py-4">
			 <div class="card shadow-custom border-0">
				 <div class="card-body">
					 <h6 class="mb-4 fw-light"><?php echo e(trans('misc.sales_last_30_days'), false); ?></h6>
					 <div style="height: 350px">
						<canvas id="ChartSales"></canvas>
					</div>
				 </div>
			 </div>
		</div>

		<div class="col-lg-6 mt-0 mt-lg-3 py-4">
			 <div class="card shadow-custom border-0">
				 <div class="card-body">
					 <h6 class="mb-4 fw-light"><?php echo e(trans('admin.latest_members'), false); ?></h6>

					 <?php $__currentLoopData = User::orderBy('id','DESC')->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						 <div class="d-flex mb-3">
							  <div class="flex-shrink-0">
							    <img src="<?php echo e(Storage::url(config('path.avatar').$user->avatar), false); ?>" width="50" class="rounded-circle" />
							  </div>
							  <div class="flex-grow-1 ms-3">
							    <h6 class="m-0 fw-light">
										<a href="<?php echo e(url($user->username), false); ?>" target="_blank">
											<?php echo e($user->name ?: $user->username, false); ?>

											</a>
											<small class="float-end badge rounded-pill bg-<?php echo e($user->status == 'active' ? 'success' : ($user->status == 'pending' ? 'info' : 'warning'), false); ?>">
												<?php echo e($user->status == 'active' ? trans('misc.active') : ($user->status == 'pending' ? trans('misc.pending') : trans('admin.suspended')), false); ?>

											</small>
									</h6>
									<div class="w-100 small">
										<?php echo e('@'.$user->username, false); ?> / <?php echo e(Helper::formatDate($user->date), false); ?>

									</div>
							  </div>
							</div>
					 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					 <?php if($totalUsers == 0): ?>
						 <small><?php echo e(trans('admin.no_result'), false); ?></small>
					 <?php endif; ?>
				 </div>

				 <?php if($totalUsers != 0): ?>
				 <div class="card-footer bg-light border-0 p-3">
					   <a href="<?php echo e(url('panel/admin/members'), false); ?>" class="text-muted font-weight-medium d-flex align-items-center justify-content-center arrow">
							 <?php echo e(trans('admin.view_all_members'), false); ?>

						 </a>
					 </div>
				 <?php endif; ?>

			 </div>
		</div>

		<div class="col-lg-6 mt-0 mt-lg-3 py-4">
			 <div class="card shadow-custom border-0">
				 <div class="card-body">
					 <h6 class="mb-4 fw-light"><?php echo e(trans('admin.latest_images'), false); ?></h6>

					 <?php $__currentLoopData = Images::orderBy('id','DESC')->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						 <div class="d-flex mb-3">
							  <div class="flex-shrink-0">
							    <img src="<?php echo e(Storage::url(config('path.thumbnail').$image->thumbnail), false); ?>" width="50" class="rounded" />
							  </div>
							  <div class="flex-grow-1 ms-3">
							    <h6 class="m-0 fw-light">
										<a href="<?php echo e(url('photo', $image->id), false); ?>" target="_blank">
											<?php echo e($image->title, false); ?>

											</a>
											<small class="float-end badge rounded-pill bg-<?php echo e($image->status == 'active' ? 'success' : 'warning', false); ?>">
												<?php echo e($image->status == 'active' ? trans('misc.active') : trans('misc.pending'), false); ?>

											</small>
									</h6>
									<div class="w-100 small">
										<?php echo e(trans('misc.by'), false); ?> <?php echo e('@'.$image->user()->username, false); ?> / <?php echo e(Helper::formatDate($image->date), false); ?>

									</div>
							  </div>
							</div>
					 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					 <?php if($totalImages == 0): ?>
						 <small><?php echo e(trans('admin.no_result'), false); ?></small>
					 <?php endif; ?>
				 </div>

				 <?php if($totalImages != 0): ?>
				 <div class="card-footer bg-light border-0 p-3">
					   <a href="<?php echo e(url('panel/admin/images'), false); ?>" class="text-muted font-weight-medium d-flex align-items-center justify-content-center arrow">
							 <?php echo e(trans('admin.view_all_images'), false); ?>

						 </a>
					 </div>
					  <?php endif; ?>
			 </div>
		</div>

	</div><!-- end row -->
</div><!-- end content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
  <script src="<?php echo e(asset('public/js/Chart.min.js'), false); ?>"></script>

  <script type="text/javascript">

function decimalFormat(nStr)
{
  <?php if($settings->decimal_format == 'dot'): ?>
	 $decimalDot = '.';
	 $decimalComma = ',';
	 <?php else: ?>
	 $decimalDot = ',';
	 $decimalComma = '.';
	 <?php endif; ?>

   <?php if($settings->currency_position == 'left'): ?>
   currency_symbol_left = '<?php echo e($settings->currency_symbol, false); ?>';
   currency_symbol_right = '';
   <?php else: ?>
   currency_symbol_right = '<?php echo e($settings->currency_symbol, false); ?>';
   currency_symbol_left = '';
   <?php endif; ?>

    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? $decimalDot + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + $decimalComma + '$2');
    }
    return currency_symbol_left + x1 + x2 + currency_symbol_right;
  }

  function transparentize(color, opacity) {
			var alpha = opacity === undefined ? 0.5 : 1 - opacity;
			return Color(color).alpha(alpha).rgbString();
		}

  var init = document.getElementById("Chart").getContext('2d');

  const gradient = init.createLinearGradient(0, 0, 0, 300);
                    gradient.addColorStop(0, '#268707');
                    gradient.addColorStop(1, '#2687072e');

  const lineOptions = {
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        hitRadius: 5,
                        pointHoverBorderWidth: 3
                    }

  var ChartArea = new Chart(init, {
      type: 'line',
      data: {
          labels: [<?php echo $label; ?>],
          datasets: [{
              label: '<?php echo e(trans('misc.earnings'), false); ?>',
              backgroundColor: gradient,
              borderColor: '#268707',
              data: [<?php echo $data; ?>],
              borderWidth: 2,
              fill: true,
              lineTension: 0.4,
              ...lineOptions
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                    min: 0, // it is for ignoring negative step.
                     display: true,
                      maxTicksLimit: 8,
                      padding: 10,
                      beginAtZero: true,
                      callback: function(value, index, values) {
                          return '<?php if($settings->currency_position == 'left'): ?><?php echo e($settings->currency_symbol, false); ?><?php endif; ?>' + value + '<?php if($settings->currency_position == 'right'): ?><?php echo e($settings->currency_symbol, false); ?><?php endif; ?>';
                      }
                  }
              }],
              xAxes: [{
                gridLines: {
                  display:false
                },
                display: true,
                ticks: {
                  maxTicksLimit: 15,
                  padding: 5,
                }
              }]
          },
          tooltips: {
            mode: 'index',
            intersect: false,
            reverse: true,
            backgroundColor: '#000',
            xPadding: 16,
            yPadding: 16,
            cornerRadius: 4,
            caretSize: 7,
              callbacks: {
                  label: function(t, d) {
                      var xLabel = d.datasets[t.datasetIndex].label;
                      var yLabel = t.yLabel == 0 ? decimalFormat(t.yLabel) : decimalFormat(t.yLabel.toFixed(2));
                      return xLabel + ': ' + yLabel;
                  }
              },
          },
          hover: {
            mode: 'index',
            intersect: false
          },
          legend: {
              display: false
          },
          responsive: true,
          maintainAspectRatio: false
      }
  });

	// Sales last 30 days
	var sales = document.getElementById("ChartSales").getContext('2d');

  const gradientSales = sales.createLinearGradient(0, 0, 0, 300);
                    gradientSales.addColorStop(0, '#268707');
                    gradientSales.addColorStop(1, '#2687072e');

  const lineOptionsSales = {
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        hitRadius: 5,
                        pointHoverBorderWidth: 3
                    }

  var ChartArea = new Chart(sales, {
      type: 'bar',
      data: {
          labels: [<?php echo $label; ?>],
          datasets: [{
              label: '<?php echo e(trans('misc.sales'), false); ?>',
              backgroundColor: '#268707',
              borderColor: '#268707',
              data: [<?php echo $datalastSales; ?>],
              borderWidth: 2,
              fill: true,
              lineTension: 0.4,
              ...lineOptionsSales
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                    min: 0, // it is for ignoring negative step.
                     display: true,
                      maxTicksLimit: 8,
                      padding: 10,
                      beginAtZero: true,
                      callback: function(value, index, values) {
                          return value;
                      }
                  }
              }],
              xAxes: [{
                gridLines: {
                  display:false
                },
                display: true,
                ticks: {
                  maxTicksLimit: 15,
                  padding: 5,
                }
              }]
          },
          tooltips: {
            mode: 'index',
            intersect: false,
            reverse: true,
            backgroundColor: '#000',
            xPadding: 16,
            yPadding: 16,
            cornerRadius: 4,
            caretSize: 7,
              callbacks: {
                  label: function(t, d) {
                      var xLabel = d.datasets[t.datasetIndex].label;
                      var yLabel = t.yLabel;
                      return xLabel + ': ' + yLabel;
                  }
              },
          },
          hover: {
            mode: 'index',
            intersect: false
          },
          legend: {
              display: false
          },
          responsive: true,
          maintainAspectRatio: false
      }
  });
  </script>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\demo\gostock\_gostock\Script\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>