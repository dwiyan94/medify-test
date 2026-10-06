

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <!-- Form Filter Kategori -->
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <!-- Form GET mengarah ke halaman index itu sendiri -->
            <form action="<?php echo e(url('kategori')); ?>" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="kode" class="form-control" placeholder="Filter Kode Kategori" value="<?php echo e(request('kode')); ?>">
                </div>
                <div class="col-md-4">
                    <input type="text" name="nama" class="form-control" placeholder="Filter Nama Kategori" value="<?php echo e(request('nama')); ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="<?php echo e(url('kategori')); ?>" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Kategori -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Kategori Items</h5>
            <a href="<?php echo e(url('kategori/form/new')); ?>" class="btn btn-light btn-sm text-primary fw-bold">Tambah Kategori</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="20%">Kode Kategori</th>
                            <th>Nama Kategori</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($kategori->kode); ?></td>
                            <td><?php echo e($kategori->nama); ?></td>
                            <td class="text-center">
                                <a href="<?php echo e(url('kategori/view/' . $kategori->id)); ?>" class="btn btn-info btn-sm text-white">View</a>
                                <a href="<?php echo e(url('kategori/form/edit/' . $kategori->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?php echo e(url('kategori/delete/' . $kategori->id)); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori <?php echo e($kategori->nama); ?>? Data yang dihapus tidak dapat dikembalikan.')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Data kategori tidak ditemukan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Apache24\htdocs\medify_test-development\resources\views/kategori/index.blade.php ENDPATH**/ ?>