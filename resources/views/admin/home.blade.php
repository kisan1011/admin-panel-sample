@extends('layouts.app')
@section('content')

<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$dashboard['users']}}</h3>

                <p>Total User</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{url('users')}}" class="small-box-footer">View User <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$dashboard['category']}}</h3>

                <p>Total Category</p>
              </div>
              <div class="icon">
                <i class="fa fa-crosshairs"></i>
              </div>
              <a href="{{url('category')}}" class="small-box-footer">View Category <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection