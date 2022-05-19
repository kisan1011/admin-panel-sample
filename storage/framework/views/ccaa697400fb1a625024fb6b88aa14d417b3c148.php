<div>
    <?php echo $__env->make('livewire.createcategory', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('livewire.updatecategory', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(session()->has('message')): ?>
        <div class="alert alert-success" style="margin-top:30px;">
          <?php echo e(session('message')); ?>

        </div>
    <?php endif; ?>
    <button class="btn btn-primary float-right" id="add_category_btn" data-toggle="modal" data-target="#exampleModal" type="button"><i class="fas fa-plus"></i> Add Category</button>
    <br><br>
    <div class="col-md-12 table-responsive">
        <table id="tbl_categories" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($post->id); ?></td>
                    <td><img src="<?php echo e(asset('storage/app/public').'/'.$post->image); ?>" width="50" height="50" style="object-fit:cover;"></td>
                    <td><?php echo e($post->name); ?></td>
                    <td>
                    <button data-toggle="modal" data-target="#updateModal" wire:click="edit(<?php echo e($post->id); ?>)" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete(<?php echo e($post->id); ?>)" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\jayesh\admin-panel-sample\resources\views/livewire/category.blade.php ENDPATH**/ ?>