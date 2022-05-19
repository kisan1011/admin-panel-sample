<!DOCTYPE html>
<html>
<head>
  @include('layouts.header')
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
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
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto dashboard_li_a">
      <li class="nav-item dropdown">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#logout" class="btn btn-block btn-danger btn-sm">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('profiles')}}" class="brand-link">
      <h2>{{\Config::get('app.name')}}</h2>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('home')}}" class="nav-link {{ request()->is('home') || request()->is('/') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('users')}}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('profiles')}}" class="nav-link {{ request()->is('profiles') ? 'active' : '' }}">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('category')}}" class="nav-link {{ request()->is('category*') ? 'active' : '' }}">
              <i class="nav-icon fa fa-crosshairs"></i>
              <p>
                Category
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        @include('flash::message')
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ $title ?? '' }}</h1>
        </div>
        </div>
      </div>
    </section>
    @yield('content')
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; @php echo date('Y'); @endphp {{\Config::get('app.name')}}.</strong> All rights reserved.
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<div class="modal fade" id="logout">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Logout</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to logout?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{url('logout')}}" type="button" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
@livewireScripts
<script type="text/javascript">
    window.livewire.on('userStore', () => {
        $('#exampleModal').modal('hide');
    });
</script>
</body>
<script>
    $(window).on('load', function () {
        $('#building').css('display', 'none');
    });
</script>
</html>
