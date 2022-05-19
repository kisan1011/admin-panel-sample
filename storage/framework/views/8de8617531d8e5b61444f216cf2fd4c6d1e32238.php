
<?php $__env->startSection('content'); ?>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo e($dashboard['users']); ?></h3>

                <p>Total User</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="<?php echo e(url('users')); ?>" class="small-box-footer">View User <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo e($dashboard['category']); ?></h3>

                <p>Total Category</p>
              </div>
              <div class="icon">
                <i class="fa fa-crosshairs"></i>
              </div>
              <a href="<?php echo e(url('category')); ?>" class="small-box-footer">View Category <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\jayesh\admin-panel-sample\resources\views/admin/home.blade.php ENDPATH**/ ?>