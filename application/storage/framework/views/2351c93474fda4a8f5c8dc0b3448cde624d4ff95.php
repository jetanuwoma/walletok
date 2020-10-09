

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-md-9 ">
        	<div class="card">
            <div class="body">
                <row class="clearfix">
                    <?php if($_ENV['APP_DEMO']): ?>
                        <div class="alert alert-info">
                            <p><strong>Heads up!</strong> Use the test cards for demo testing.</p>
                        </div>
                    <?php endif; ?>
                </row>
                <div class="row">
                   
                    <div class="details col-lg-8 col-md-12" id="buy_form">
                        <h3 class="product-title m-b-0"><?php echo e(__('Add funds to your wallet with Flutterwave')); ?></h3>                        
                        
                        <div class="action">
                          <form class="d-flex justify-content-left" method="post" action="<?php echo e(route('pay')); ?>">
                          	<div class="row mb-5">
		                      <div class="col-lg-12">
		                        <div class="form-group ">
		                          	<label for="message"><?php echo e(__('Value')); ?> in <?php echo e(Auth::user()->currentCurrency()->name); ?></label>
                            		<input type="number" value="1" name="amount" aria-label="Search" class="form-control" style="width: 100px" v-on:keyup="totalize"  v-on:change="totalize" >
		                        </div>
		                      </div>
		                    	<div class="col-lg-12">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
                                    <input type="hidden" name="description" value="Fund Wallet" /> <!-- Replace the value with your transaction description -->
                                    <input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
                                    <input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
                                    <input type="hidden" name="email" value="<?php echo e(Auth::user()->email); ?>" /> <!-- Replace the value with your customer email -->
                                    <input type="hidden" name="firstname" value="<?php echo e(Auth::user()->first_name); ?>" /> <!-- Replace the value with your customer firstname -->
                                    <input type="hidden" name="lastname" value="<?php echo e(Auth::user()->last_name); ?>" /> <!-- Replace the value with your customer lastname -->
                                     <input type="hidden" name="phonenumber" value="<?php echo e(Auth::user()->phonenumber); ?>" /> <!-- Replace the value with your customer phonenumber -->

                            	<input type="hidden" name="product_id" value="18">
                              <input class="btn btn-primary btn-round waves-effect" value="<?php echo e(__('Purchase')); ?>" type="submit">
		                    	</div>
		                    </div>
                           
                              
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
  <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>