<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="<?php echo e(url('master-items')); ?>" class="btn btn-secondary">Kembali ke Daftar Item</a>
            </div>
            <div class="card">

                <?php if($method == 'new'): ?>
                <div class="card-header">Buat Master Item Baru</div>
                <?php else: ?>
                <div class="card-header">Edit Master Item</div>
                <?php endif; ?>

                <div class="card-body">
                    <?php echo $__env->make('master_items.form.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Apache24\htdocs\medify_test-development\resources\views/master_items/form/index.blade.php ENDPATH**/ ?>