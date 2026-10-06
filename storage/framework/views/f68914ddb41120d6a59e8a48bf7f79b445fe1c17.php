<!DOCTYPE html>
<html>
<head>
    <title>Print Kategori - <?php echo e($kategori->kode); ?></title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { margin-bottom: 20px; text-align: center; }
        .info { margin-bottom: 20px; }
        
        /* Styling Tabel[cite: 8] */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        
        /* Styling Footer[cite: 8] */
        .footer { 
            position: fixed; 
            bottom: 0px; 
            left: 0px; 
            right: 0px; 
            text-align: right; 
            font-size: 12px; 
            font-style: italic; 
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Detail Kategori</h2>
    </div>

    <div class="info">
        <!-- Nama dan Kode Kategori[cite: 8] -->
        <p><strong>Kode Kategori :</strong> <?php echo e($kategori->kode); ?></p>
        <p><strong>Nama Kategori :</strong> <?php echo e($kategori->nama); ?></p>
    </div>

    <!-- Tabel Daftar Item[cite: 8] -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Item</th>
                <th>Nama Item</th>
                <th>Jenis</th>
                <th>Harga Beli</th>
                <th>Supplier</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $kategori->masterItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($item->kode); ?></td>
                <td><?php echo e($item->nama); ?></td>
                <td><?php echo e($item->jenis); ?></td>
                <td>Rp <?php echo e(number_format($item->harga_beli, 0, ',', '.')); ?></td>
                <td><?php echo e($item->supplier); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada item pada kategori ini.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Informasi waktu cetak di footer[cite: 8] -->
    <div class="footer">
        Dicetak pada: <?php echo e(\Carbon\Carbon::now()->format('d/m/Y H:i:s')); ?>

    </div>
</body>
</html><?php /**PATH E:\Apache24\htdocs\medify_test-development\resources\views/kategori/pdf.blade.php ENDPATH**/ ?>