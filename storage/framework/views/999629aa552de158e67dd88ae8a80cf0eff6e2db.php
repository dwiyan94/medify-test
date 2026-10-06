<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="<?php echo e(url('master-items')); ?>" class="btn btn-secondary">Kembali ke Daftar Item</a>
            </div>
            <div class="card">
                <div class="card-header">Master Item</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td><?php echo e($data->nama); ?></td>
                        </tr>
                        <tr>
                            <th>Harga Beli</th>
                            <td>:</td>
                            <td><?php echo e($data->harga_beli); ?></td>
                        </tr>
                        <tr>
                            <th>Laba</th>
                            <td>:</td>
                            <td><?php echo e($data->laba); ?></td>
                        </tr>
                        <tr>
                            <th>Harga Jual</th>
                            <td>:</td>
                            <td><?php echo e($data->harga_beli + $data->harga_beli * $data->laba / 100); ?></td>
                        </tr>
                        <tr>
                            <th>Supplier</th>
                            <td>:</td>
                            <td><?php echo e($data->supplier); ?></td>
                        </tr>
                        <tr>
                            <th>Jenis</th>
                            <td>:</td>
                            <td><?php echo e($data->jenis); ?></td>
                        </tr>
                    </table>
                    <a class="btn btn-info" href="<?php echo e(url('master-items/form/edit')); ?>/<?php echo e($data->id); ?>">Edit</a>
                    <a class="btn btn-danger" href="<?php echo e(url('master-items/delete')); ?>/<?php echo e($data->id); ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Apache24\htdocs\medify_test-development\resources\views/master_items/single/index.blade.php ENDPATH**/ ?>