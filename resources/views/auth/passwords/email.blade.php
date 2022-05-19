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
      @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
          </div>
        </div>
      </form>
      <p class="mb-1">
        <a class="btn btn-link" href="{{ route('login') }}">{{ __('Login here?') }}</a>
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
