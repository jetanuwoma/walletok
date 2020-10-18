<aside id="leftsidebar" class="sidebar h_menu">
    <div class="container">
        <div class="row clearfix">
            <div class="col-12">
                <div class="menu">
                    <ul class="list">
                        <?php if(auth()->guard()->guest()): ?>
                            <li><a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a></li>
                            <li><a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a></li>
                        <?php else: ?>
                        <li class="header">MAIN</li>
                        <li class="<?php echo e((Route::is('home') ? 'active open' : '')); ?>"> 
                            <a href="<?php echo e(route('home')); ?>"><i class=" icon-layers"></i><span><?php echo e(__('Home')); ?></span></a>
                        </li>

                        
                        <li class="<?php echo e((Route::is('sendMoneyForm') ? 'active open' : '')); ?>"> 
                            <a href="<?php echo e(route('sendMoneyForm')); ?>"><i class="icon-arrow-right"></i><span><?php echo e(__('Send Money')); ?></span></a>
                        </li>
            
                        <li class="<?php echo e((Route::is('requestMoneyForm') ? 'active open' : '')); ?>"> 
                            <a href="<?php echo e(route('withdrawal.form')); ?>"><i class="icon-arrow-left"></i><span><?php echo e(__('Withdraw Money')); ?></span></a>
                        </li>
                        <li class="<?php echo e((Route::is('mymerchants') ? 'active open' : '')); ?>"> 
                            <a href="<?php echo e(route('mymerchants')); ?>"><i class="icon-speedometer"></i><span>
                            <?php echo e(__('Developers API')); ?></span></a>
                        </li>
                      
                        <?php if(Auth::user()->role_id != 1): ?>
                        <li class="<?php echo e((Route::is('my_vouchers') ? 'active open' : '')); ?>"> 
                            <a href="<?php echo e(url('/')); ?>/my_vouchers"><i class="icon-speedometer"></i><span>
                            <?php echo e(__('Vouchers')); ?></span></a>
                        </li>
                        <?php endif; ?>
                        
                        <?php endif; ?>               
                    </ul>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- Right Sidebar -->
<aside id="rightsidebar" class="right-sidebar">
    <div class="slim_scroll">
        <div class="card">
            <h6>Demo Skins</h6>
            <ul class="choose-skin list-unstyled">
                <li data-theme="purple">
                    <div class="purple"></div>
                </li>                   
                <li data-theme="blue">
                    <div class="blue"></div>
                </li>
                <li data-theme="cyan">
                    <div class="cyan"></div>
                </li>
                <li data-theme="green" class="active">
                    <div class="green"></div>
                </li>
                <li data-theme="orange">
                    <div class="orange"></div>
                </li>
                <li data-theme="blush">
                    <div class="blush"></div>
                </li>
            </ul>
        </div>
        <div class="card theme-light-dark">
            <h6>Left Menu</h6>
            <button class="btn btn-default btn-block btn-round btn-simple t-light">Light</button>
            <button class="btn btn-default btn-block btn-round t-dark">Dark</button>
        </div> 
    </div>
  
</aside>
<div class="modal fade token-form" tabindex="-1" role="dialog" aria-labelledby="tokenForm" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <form class="modal-content" action="<?php echo e(route('settoken')); ?>">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Account Pin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="number" minlength="4" maxlength="4" name="token" class="form-control">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Set Pin</button>
          </div>
      </div>
    </form>
  </div>

  <div class="modal fade token-check" tabindex="-1" role="dialog" aria-labelledby="tokenForm" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Account Pin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="number" minlength="4" maxlength="4" name="token" class="form-control token-text">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary submit-token-check">Submit</button>
          </div>
      </div>
    </div>
  </div>