

<?php $__env->startSection('content'); ?>

    <div class="row clearfix">
        <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		
		<div class="col-md-9 " >
			<?php if(auth()->guard()->check()): ?>
				<div class="row clearfix">
				   
					<div class="col">
						<div class="card info-box-2">
							<div class="header" style="padding-bottom: 0">
								<h2><strong>Account </strong> Number</h2>
								<ul class="header-dropdown">
									<li class="remove">
										<a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
									</li>
								</ul>
							</div>
							<div class="body" style="padding-top: 0">
								<div class="content">
									<div class="number"><?php echo e(Auth::user()->getWalletNumber()); ?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			 
					<?php endif; ?>
        	<?php echo $__env->make('partials.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    	</div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>