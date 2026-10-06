<!-- <form method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($method == 'edit'): ?>
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text" class="form-control" name="kode_barang" required readonly value="<?php echo e($item->kode ?? ''); ?>">
    </div>
    <?php endif; ?>

    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" required  value="<?php echo e($item->nama ?? ''); ?>">
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" required  value="<?php echo e($item->harga_beli ?? ''); ?>">
    </div>

    <div class="form-group">
        <label>Laba (dalam persen)</label>
        <input type="number" class="form-control" name="laba" required  value="<?php echo e($item->laba ?? ''); ?>">
    </div>

    <?php $selected = $item->supplier ?? ''; ?>
    <div class="form-group">
        <label>Supplier</label>
        <select class="form-control" required name="supplier">
            <option <?php if($selected == ''): ?> selected <?php endif; ?> value="">--Pilih--</option>
            <option <?php if($selected == 'Tokopaedi'): ?> selected <?php endif; ?>>Tokopaedi</option>
            <option <?php if($selected == 'Bukulapuk'): ?> selected <?php endif; ?>>Bukulapuk</option>
            <option <?php if($selected == 'TokoBagas'): ?> selected <?php endif; ?>>TokoBagas</option>
            <option <?php if($selected == 'E Commurz'): ?> selected <?php endif; ?>>E Commurz</option>
            <optio <?php if($selected == 'Blublu'): ?> selected <?php endif; ?>>Blublu</option>
        </select>
    </div>

    <?php $selected = $item->jenis ?? ''; ?>
    <div class="form-group">
        <label>Jenis</label>
        <select class="form-control" required name="jenis">
            <option <?php if($selected == ''): ?> selected <?php endif; ?> value="">--Pilih--</option>
            <option <?php if($selected == 'Obat'): ?> selected <?php endif; ?>>Obat</option>
            <option <?php if($selected == 'Alkes'): ?> selected <?php endif; ?>>Alkes</option>
            <option <?php if($selected == 'Matkes'): ?> selected <?php endif; ?>>Matkes</option>
            <optio <?php if($selected == 'Umum'): ?> selected <?php endif; ?>>Umum</option>
            <optio <?php if($selected == 'ATK'): ?> selected <?php endif; ?>>ATK</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="form-label">Upload Gambar Barang (Opsional)</label>
        <input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
        <small class="text-muted">Format yang didukung: JPG, JPEG, PNG.</small>
    </div>
                    

    <button class="btn btn-primary mt-3">Submit</button>

</form> -->



<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card shadow-sm">
        <!-- Header card berubah warna tergantung method -->
        <div class="card-header <?php echo e($method == 'edit' ? 'bg-warning text-dark' : 'bg-primary text-white'); ?>">
            <h5 class="mb-0"><?php echo e($method == 'edit' ? 'Edit Master Item' : 'Tambah Master Item Baru'); ?></h5>
        </div>
        <div class="card-body">
            
            <!-- URL action dinamis menyesuaikan method dan ID -->
            <form action="<?php echo e(url('master-items/form/' . $method . '/' . ($item->id ?? 0))); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="row">
                        
                        <!-- Kolom Kode Barang HANYA muncul saat edit -->
                        <?php if($method == 'edit'): ?>
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" name="kode" class="form-control" value="<?php echo e($item->kode); ?>" readonly>
                        </div>
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo e($item->nama ?? ''); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <select class="form-control" required name="jenis">
                                <option <?php if($selected == ''): ?> selected <?php endif; ?> value="">--Pilih--</option>
                                <option <?php if($selected == 'Obat'): ?> selected <?php endif; ?>>Obat</option>
                                <option <?php if($selected == 'Alkes'): ?> selected <?php endif; ?>>Alkes</option>
                                <option <?php if($selected == 'Matkes'): ?> selected <?php endif; ?>>Matkes</option>
                                <optio <?php if($selected == 'Umum'): ?> selected <?php endif; ?>>Umum</option>
                                <optio <?php if($selected == 'ATK'): ?> selected <?php endif; ?>>ATK</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga Beli (Rp)</label>
                            <input type="number" name="harga_beli" class="form-control" value="<?php echo e($item->harga_beli ?? ''); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Persentase Laba (%)</label>
                            <input type="number" name="laba" class="form-control" value="<?php echo e($item->laba ?? ''); ?>" required>
                        </div>

                        <div class="mb-3">
                            <?php $selected = $item->supplier ?? ''; ?>
                            <div class="form-group">
                                <label>Supplier</label>
                                <select class="form-control" required name="supplier">
                                    <option <?php if($selected == ''): ?> selected <?php endif; ?> value="">--Pilih--</option>
                                    <option <?php if($selected == 'Tokopaedi'): ?> selected <?php endif; ?>>Tokopaedi</option>
                                    <option <?php if($selected == 'Bukulapuk'): ?> selected <?php endif; ?>>Bukulapuk</option>
                                    <option <?php if($selected == 'TokoBagas'): ?> selected <?php endif; ?>>TokoBagas</option>
                                    <option <?php if($selected == 'E Commurz'): ?> selected <?php endif; ?>>E Commurz</option>
                                    <optio <?php if($selected == 'Blublu'): ?> selected <?php endif; ?>>Blublu</option>
                                </select>
                            </div>
                        </div>
                </div>

                <div class="mb-3">
                    <label>Pilih Kategori</label>
                    <select name="kategori_ids[]" class="form-select">
                        <?php $__currentLoopData = $semua_kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kat->id); ?>" 
                                
                                <?php if(isset($item) && $item->kategoris->contains($kat->id)): ?> selected <?php endif; ?>>
                                <?php echo e($kat->nama); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                

                <!-- Bagian Gambar -->
                <div class="mb-4">
                    <label class="form-label">Gambar Barang</label>

                    <!-- Preview gambar lama hanya muncul saat edit dan jika gambar ada -->
                    <?php if($method == 'edit' && isset($item->image)): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('images/master_items/' . $item->image)); ?>" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    <?php endif; ?>

                    <input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                    <small class="text-muted">
                        <?php echo e($method == 'edit' ? 'Biarkan kosong jika tidak ingin mengganti gambar.' : 'Opsional. Format: JPG, JPEG, PNG.'); ?>

                    </small>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="<?php echo e(url('master-items')); ?>" class="btn btn-secondary me-2">Batal</a>
                    <!-- Warna dan teks tombol berubah dinamis -->
                    <button type="submit" class="btn <?php echo e($method == 'edit' ? 'btn-warning' : 'btn-primary'); ?>">
                        <?php echo e($method == 'edit' ? 'Update Data' : 'Simpan Data'); ?>

                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Apache24\htdocs\medify_test-development\resources\views/master_items/form/form.blade.php ENDPATH**/ ?>