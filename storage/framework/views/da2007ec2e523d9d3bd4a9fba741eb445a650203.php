<!DOCTYPE html>
<html>
<head>
  <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body class="hold-transition login-page">
<div id="building" class="loader" style="display: block">
  <div id="blocks">
      <div class="float-left">
          <div class="b" id="b1"></div>
          <div class="b" id="b2"></div>
          <div class="b" id="b3"></div>
          <div class="b" id="b4"></div>
          <p style="color:white">Please wait...</p>
      </div>
  </div>
</div>
<div class="login-box">
  <div class="login-logo">
    <p><?php echo e(\Config::get('app.name')); ?></p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form method="POST" action="<?php echo e(url('/login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="input-group mb-3">
          <input id="email" type="text" class="form-control <?php if($errors->has('email')): ?> is-invalid <?php endif; ?>" placeholder="Username or Email Address" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
            <?php if($errors->has('email')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first()); ?></strong>
                </span>
            <?php endif; ?>
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control <?php if($errors->has('password')): ?> is-invalid <?php endif; ?>" name="password" placeholder="Password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?php if($errors->has('password')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
          <?php endif; ?>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary login_remember_check_box">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
              <label for="remember">
                <?php echo e(__('Remember Me')); ?>

              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('Login')); ?></button>
          </div>
        </div>
      </form>
      <p class="mb-1">
        <?php if(Route::has('password.request')): ?>
            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>"><?php echo e(__('Forgot Your Password?')); ?></a>
        <?php endif; ?>
      </p>
    </div>
  </div>
</div>
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
<script>
    $(window).on('load', function () {
        $('#building').css('display', 'none');
    });
</script>
</html>
<?php /**PATH C:\xampp\htdocs\jayesh\admin-panel-sample\resources\views/auth/login.blade.php ENDPATH**/ ?>