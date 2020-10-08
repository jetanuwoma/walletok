<?php $__env->startSection('content'); ?>

    <div class="row">
        <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-md-9 " style="padding-right: 0" id="#sendMoney">
          <?php echo $__env->make('flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <div class="card">
            <div class="header">
                <h2><strong><?php echo e(__('Money')); ?></strong> <?php echo e(__("Transfer")); ?></h2>
                
            </div>
            <div class="body">
              <form action="<?php echo e(route('sendMoney')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                      <div class="form-group <?php echo e($errors->has('merchant_site_url') ? ' has-error' : ''); ?>">
                        <div class="form-group">
                          <label for="deposit_method"><?php echo e(__('Currency')); ?> [ <span class="text-primary"><?php echo e(Auth::user()->currentCurrency()->code); ?></span> ]</label>
                          <select class="form-control" id="currency" name="currency">
                            <option value="<?php echo e(Auth::user()->currentCurrency()->id); ?>" data-value="<?php echo e(Auth::user()->currentCurrency()->id); ?>" selected><?php echo e(Auth::user()->currentCurrency()->name); ?> </option>
                            <?php $__empty_1 = true; $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($currency->id); ?>" data-value="<?php echo e($currency->id); ?>"><?php echo e($currency->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>


                            <?php endif; ?>
                          </select>
                          <?php if($errors->has('currency')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('currency')); ?></strong>
                            </span>
                        <?php endif; ?>
                        </div>
                      </div>
                </div>
                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group <?php echo e($errors->has('amount') ? ' has-danger' : ''); ?>">
                          <label for="amount"><?php echo e(__('Amount')); ?></label>
                          <input type="number" class="form-control" id="amount" name="amount" value="<?php echo e(old('amount')); ?>" required placeholder="5.00" pattern="[0-9]+([\.,][0-9]+)?" 
                          step="0.01" >
                           <?php if($errors->has('amount')): ?>
                                <div class="form-control-feedback">
                                    <strong><?php echo e($errors->first('amount')); ?></strong>
                                </div>
                            <?php endif; ?>
                        </div>
                      </div>
                      
                      
                      <?php if(Auth::user()->currentCurrency()->symbol != '(BTC)'): ?>
                      <div class="form-group">
                          <label for="deposit_method">Select Method </label>
                          <select class="form-control" id="payment_type" name="payment_type" >
                              <option value="User Wallet" data-value="wallet">User Wallet</option>
                            <option value="Paypal" data-value="paypal">Paypal</option>
                          </select>
                        
                        </div>
                      <?php endif; ?>
                      
                      
                      
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                      <div class="col">

                        <div class="form-group">
                          <?php if(Auth::user()->currentCurrency()->symbol != '(BTC)'): ?>
                          <div class="account_group">
                            <label for="wallet_number">Account Number</label>
                            <input type="text" class="form-control" id="wallet_number" name="account" value="<?php echo e(old('account')); ?>" placeholder="Receivers Account Number" 
                           >
                          </div>
                          <div class="paypal_group">
                              <label for="payal_details">Paypal Email</label>
                              <input type="text" class="form-control" id="paypal" name="paypal" value="<?php echo e(old('paypal')); ?>"  placeholder="Receivers Paypal Email" 
                             >
                          </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group <?php echo e($errors->has('description') ? ' has-danger' : ''); ?>">
                          <label for="description">Payment Detail</label>
                          <?php if(Auth::user()->currentCurrency()->symbol == '(BTC)'): ?>
                          <input type="text" class="form-control" id="address" name="address" value="<?php echo e(old('address')); ?>" required placeholder="receivers address" 
                           >
                           <?php else: ?>
                           <textarea class="form-control" rows="5" id="description" name="description" placeholder="Note" ></textarea>
                           
                           <?php if($errors->has('description')): ?>
                                <div class="form-control-feedback">
                                    <strong><?php echo e($errors->first('description')); ?></strong>
                                </div>
                            <?php endif; ?>
                          <?php endif; ?>
                         
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                      <div class="col">
                        <input type="submit" class="btn btn-primary float-right" value="<?php echo e(__('Send Money')); ?>">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </form>                        
                
            </div>
          </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
$(document).ready(function() {
  $('.paypal_group').hide();
})
$( "#currency" )
  .change(function () {
    $( "#currency option:selected" ).each(function() {
      window.location.replace("<?php echo e(url('/')); ?>/wallet/"+$(this).val());
  });
})

$('#payment_type').change(function(event) {
  if($(this).val() == 'Paypal') {
    $('.paypal_group').show();
    $('.account_group').hide();
  } else {
    $('.paypal_group').hide();
    $('.account_group').show();
  }
})
</script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
  <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>