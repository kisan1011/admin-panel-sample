<!DOCTYPE html>
<html>
<head>
  @include('layouts.header')
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
    <p>{{\Config::get('app.name')}}</p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form method="POST" action="{{ url('/login') }}">
        @csrf
        <div class="input-group mb-3">
          <input id="email" type="text" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="Username or Email Address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
            @if($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{$errors->first()}}</strong>
                </span>
            @endif
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @if($errors->has('password')) is-invalid @endif" name="password" placeholder="Password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @if($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
          @endif
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary login_remember_check_box">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
          </div>
        </div>
      </form>
      <p class="mb-1">
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
        @endif
      </p>
    </div>
  </div>
</div>
@include('layouts.footer')
</body>
<script>
    $(window).on('load', function () {
        $('#building').css('display', 'none');
    });
</script>
</html>
