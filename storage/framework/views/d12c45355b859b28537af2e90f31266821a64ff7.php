

<table id="table" class="table table-striped" style="width:100%">
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>    
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Supplier</th>
            <th>Image</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table><?php /**PATH E:\Apache24\htdocs\medify_test-development\resources\views/master_items/index/table.blade.php ENDPATH**/ ?>