 
<?php $__env->startSection('content'); ?>
<div class="login-box">
    <div class="login-logo">
  IIT Indore<br>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><?php echo e(__('Login')); ?></p>

            <form action="<?php echo e(route('login')); ?>" method="post">
                <?php echo csrf_field(); ?>
              <?php if($errors->has('email')): ?>
              <div class="alert alert-danger">                       
                                        <?php echo e($errors->first('email')); ?>                                    
              </div><?php endif; ?>
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span> <?php if($errors->has('email')): ?>
                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span> <?php endif; ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                        <?php if($errors->has('password')): ?>
                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span> <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
                <input type="checkbox"> Remember Me
              </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                  <!-- <a href="<?php echo e(url('/redirect')); ?>" class="btn btn-block btn-primary">Login With Google</a> -->
                <a href="<?php echo e(url('/redirect')); ?>" class="btn btn-block btn-primary">Click Here login with institute email id</a>
       
            </div>
            <!-- /.social-auth-links -->

            
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>