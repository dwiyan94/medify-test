@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Bagian 1: Informasi Nama dan Kode Kategori -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Detail Kategori</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="150" class="text-muted">Kode Kategori</th>
                            <td class="fw-bold">: {{ $kategori->kode }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Nama Kategori</th>
                            <td class="fw-bold">: {{ $kategori->nama }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ url('kategori') }}" class="btn btn-secondary">Kembali ke Daftar</a>

                <a href="{{ url('kategori/print/' . $kategori->id) }}" class="btn btn-danger">
                    Cetak PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Bagian 2: List Item yang memiliki kategori tersebut -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Daftar Item pada Kategori Ini</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-scrollable" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-dark" style="position: sticky; top: 0; z-index: 1;">
                        <tr>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Jenis</th>
                            <th>Harga Beli</th>
                            <th>Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Looping relasi Many-to-Many ($kategori->masterItems) -->
                        @forelse($kategori->masterItems as $item)
                        <tr>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                            <td>{{ $item->supplier }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada item yang terhubung dengan kategori ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection