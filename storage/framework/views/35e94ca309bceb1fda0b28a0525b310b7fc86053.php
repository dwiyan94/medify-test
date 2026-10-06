

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <!-- Ubah warna header dinamis sesuai method -->
                <div class="card-header <?php echo e($method == 'edit' ? 'bg-warning text-dark' : 'bg-primary text-white'); ?>">
                    <h5 class="mb-0"><?php echo e($method == 'edit' ? 'Edit Kategori' : 'Tambah Kategori Baru'); ?></h5>
                </div>
                
                <div class="card-body">
                    <form action="<?php echo e(url('kategori/form/' . $method . '/' . ($kategori->id ?? 0))); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <!-- Kolom Kode Kategori hanya muncul dan bersifat readonly saat edit -->
                        <?php if($method == 'edit'): ?>
                        <div class="mb-3">
                            <label class="form-label">Kode Kategori</label>
                            <input type="text" name="kode" class="form-control bg-light" value="<?php echo e($kategori->kode); ?>" readonly>
                            <small class="text-muted">Kode kategori dibuat otomatis oleh sistem dan tidak dapat diubah.</small>
                        </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="<?php echo e($kategori->nama ?? ''); ?>" placeholder="Contoh: Obat Sirup" required autofocus>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="<?php echo e(url('kategori')); ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn <?php echo e($method == 'edit' ? 'btn-warning' : 'btn-primary'); ?>">
                                <?php echo e($method == 'edit' ? 'Update Kategori' : 'Simpan Kategori'); ?>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Apache24\htdocs\medify_test-development\resources\views/kategori/form.blade.php ENDPATH**/ ?>