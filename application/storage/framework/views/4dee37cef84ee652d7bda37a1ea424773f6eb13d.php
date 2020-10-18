

<?php $__env->startSection('content'); ?>

    <div class="row">
        <?php echo $__env->make('partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="col-md-9 ">
          <?php if(Auth::user()->currentCurrency()->symbol == "(BTC)"): ?>
          <div class="card">
            <div class="header">
              <h2><strong><?php echo e(__('About')); ?></strong> BTC <?php echo e(__('withdrawals')); ?></h2>
            </div>
            <div class="body">
              <div class="row">
                <div class="col-lg-12">
                    <div >
                        Notice your withdrawal is subject approval and after withdrawal
                    </div>
                </div>
              </div>
            </div>
          </div>
          <?php else: ?>
          <div class="card">
              <div class="header">
               
              </div>
              <div class="body">
                <div class="row">
                  <div class="col-lg-12">
                     
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <div class="card">
          <div class="header">
            <h2><strong><?php echo e(__('Withdrawal Request')); ?></strong></h2>
          </div>
          <div class="body">
            <form action="<?php echo e(route('post.withdrawal')); ?>" method="post" enctype="multipart/form-data" id="withdrawal_form">
              <?php echo e(csrf_field()); ?>

              
              <div class="row">
               
                </div>
                <div class="col-lg-5 col-xs-12">
                  <div class="form-group <?php echo e($errors->has('merchant_site_url') ? ' has-error' : ''); ?>">
                    <div class="form-group">
                      <label for="bank_code"><?php echo e(__('Bank')); ?></label>
                      <select class="" id="bank_code" name="bank_code">
                          <?php $__empty_1 = true; $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <option value="<?php echo e($bank->Code); ?>"><?php echo e($bank->Name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                      </select>
                     
                    </div>
                  </div>
                </div>
                <div class="col-lg-7 col-xs-12">
                  <div class="row">
                    <div class="col">
                      <div class="form-group <?php echo e($errors->has('amount') ? ' has-error' : ''); ?>">
                       <label for="amount"><?php echo e(__('Amount')); ?></label>
                       <input type="number" name="amount" class="form-control"  v-on:keyup="totalize" v-on:change="totalize">
                        <?php if($errors->has('amount')): ?>
                            <span class="help-block">
                                <strong class="text-danger"><?php echo e($errors->first('amount')); ?></strong> <span class="text-primary"><?php echo e(Auth::user()->currentCurrency()->symbol); ?></span> 
                            </span>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group <?php echo e($errors->has('fee') ? ' has-error' : ''); ?>">
                       <label for="fee">Net [ <small class="bg-dark text-white"> <?php echo e(__('gross')); ?> -  <?php echo e(__('Fees')); ?> &nbsp;</span></small> ]</label>
                      
                      <br>
                       <h2 style="margin-top: 0" ><span >{{total}}</span> <?php echo e(Auth::user()->currentCurrency()->symbol); ?></h2> 
                        <?php if($errors->has('fee')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('fee')); ?></strong>
                            </span>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
  
              <div class="row">
                <div class="col">
                  <div class="form-group <?php echo e($errors->has('platform_id') ? ' has-error' : ''); ?>">
                   <label for="platform_id">Account Name</label>
                 <input type="text" name="account_name" id="account_name" class="form-control" required> 
                    <?php if($errors->has('account_name')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('account_name')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col">
                    <div class="form-group <?php echo e($errors->has('platform_id') ? ' has-error' : ''); ?>">
                     <label for="platform_id">Account Number</label>
                   <input type="text" name="account_number" id="account_number" class="form-control" required> 
                      <?php if($errors->has('account_number')): ?>
                          <span class="help-block">
                              <strong><?php echo e($errors->first('account_number')); ?></strong>
                          </span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
 
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-lg-12">
                  <input type="submit" class="btn btn-primary float-right" value="<?php echo e(__('Request Withdrawal')); ?>">
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
<?php echo $__env->make('withdrawals.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>

  

</script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
  <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>