@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Form Filter Kategori -->
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <!-- Form GET mengarah ke halaman index itu sendiri -->
            <form action="{{ url('kategori') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="kode" class="form-control" placeholder="Filter Kode Kategori" value="{{ request('kode') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="nama" class="form-control" placeholder="Filter Nama Kategori" value="{{ request('nama') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ url('kategori') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Kategori -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Kategori Items</h5>
            <a href="{{ url('kategori/form/new') }}" class="btn btn-light btn-sm text-primary fw-bold">Tambah Kategori</a>
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
                        @forelse($kategoris as $kategori)
                        <tr>
                            <td>{{ $kategori->kode }}</td>
                            <td>{{ $kategori->nama }}</td>
                            <td class="text-center">
                                <a href="{{ url('kategori/view/' . $kategori->id) }}" class="btn btn-info btn-sm text-white">View</a>
                                <a href="{{ url('kategori/form/edit/' . $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ url('kategori/delete/' . $kategori->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $kategori->nama }}? Data yang dihapus tidak dapat dikembalikan.')">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Data kategori tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection