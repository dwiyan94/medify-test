

<table id="table" class="table table-striped" style="width:100%">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif    
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
</table>