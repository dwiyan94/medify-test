<!-- <form method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'edit')
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text" class="form-control" name="kode_barang" required readonly value="{{$item->kode ?? ''}}">
    </div>
    @endif

    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" required  value="{{$item->nama ?? ''}}">
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" required  value="{{$item->harga_beli ?? ''}}">
    </div>

    <div class="form-group">
        <label>Laba (dalam persen)</label>
        <input type="number" class="form-control" name="laba" required  value="{{$item->laba ?? ''}}">
    </div>

    @php $selected = $item->supplier ?? ''; @endphp
    <div class="form-group">
        <label>Supplier</label>
        <select class="form-control" required name="supplier">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Tokopaedi') selected @endif>Tokopaedi</option>
            <option @if($selected == 'Bukulapuk') selected @endif>Bukulapuk</option>
            <option @if($selected == 'TokoBagas') selected @endif>TokoBagas</option>
            <option @if($selected == 'E Commurz') selected @endif>E Commurz</option>
            <optio @if($selected == 'Blublu') selected @endif>Blublu</option>
        </select>
    </div>

    @php $selected = $item->jenis ?? ''; @endphp
    <div class="form-group">
        <label>Jenis</label>
        <select class="form-control" required name="jenis">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Obat') selected @endif>Obat</option>
            <option @if($selected == 'Alkes') selected @endif>Alkes</option>
            <option @if($selected == 'Matkes') selected @endif>Matkes</option>
            <optio @if($selected == 'Umum') selected @endif>Umum</option>
            <optio @if($selected == 'ATK') selected @endif>ATK</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="form-label">Upload Gambar Barang (Opsional)</label>
        <input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
        <small class="text-muted">Format yang didukung: JPG, JPEG, PNG.</small>
    </div>
                    

    <button class="btn btn-primary mt-3">Submit</button>

</form> -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <!-- Header card berubah warna tergantung method -->
        <div class="card-header {{ $method == 'edit' ? 'bg-warning text-dark' : 'bg-primary text-white' }}">
            <h5 class="mb-0">{{ $method == 'edit' ? 'Edit Master Item' : 'Tambah Master Item Baru' }}</h5>
        </div>
        <div class="card-body">
            
            <!-- URL action dinamis menyesuaikan method dan ID -->
            <form action="{{ url('master-items/form/' . $method . '/' . ($item->id ?? 0)) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                        
                        <!-- Kolom Kode Barang HANYA muncul saat edit -->
                        @if($method == 'edit')
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" name="kode" class="form-control" value="{{ $item->kode }}" readonly>
                        </div>
                        @endif
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama" class="form-control" value="{{ $item->nama ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <select class="form-control" required name="jenis">
                                <option @if($selected == '') selected @endif value="">--Pilih--</option>
                                <option @if($selected == 'Obat') selected @endif>Obat</option>
                                <option @if($selected == 'Alkes') selected @endif>Alkes</option>
                                <option @if($selected == 'Matkes') selected @endif>Matkes</option>
                                <optio @if($selected == 'Umum') selected @endif>Umum</option>
                                <optio @if($selected == 'ATK') selected @endif>ATK</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga Beli (Rp)</label>
                            <input type="number" name="harga_beli" class="form-control" value="{{ $item->harga_beli ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Persentase Laba (%)</label>
                            <input type="number" name="laba" class="form-control" value="{{ $item->laba ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            @php $selected = $item->supplier ?? ''; @endphp
                            <div class="form-group">
                                <label>Supplier</label>
                                <select class="form-control" required name="supplier">
                                    <option @if($selected == '') selected @endif value="">--Pilih--</option>
                                    <option @if($selected == 'Tokopaedi') selected @endif>Tokopaedi</option>
                                    <option @if($selected == 'Bukulapuk') selected @endif>Bukulapuk</option>
                                    <option @if($selected == 'TokoBagas') selected @endif>TokoBagas</option>
                                    <option @if($selected == 'E Commurz') selected @endif>E Commurz</option>
                                    <optio @if($selected == 'Blublu') selected @endif>Blublu</option>
                                </select>
                            </div>
                        </div>
                </div>

                <div class="mb-3">
                    <label>Pilih Kategori</label>
                    <select name="kategori_ids[]" class="form-select">
                        @foreach($semua_kategori as $kat)
                            <option value="{{ $kat->id }}" 
                                {{-- Logika untuk menandai kategori yang sudah dipilih saat edit --}}
                                @if(isset($item) && $item->kategoris->contains($kat->id)) selected @endif>
                                {{ $kat->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                

                <!-- Bagian Gambar -->
                <div class="mb-4">
                    <label class="form-label">Gambar Barang</label>

                    <!-- Preview gambar lama hanya muncul saat edit dan jika gambar ada -->
                    @if($method == 'edit' && isset($item->image))
                        <div class="mb-2">
                            <img src="{{ asset('images/master_items/' . $item->image) }}" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif

                    <input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                    <small class="text-muted">
                        {{ $method == 'edit' ? 'Biarkan kosong jika tidak ingin mengganti gambar.' : 'Opsional. Format: JPG, JPEG, PNG.' }}
                    </small>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url('master-items') }}" class="btn btn-secondary me-2">Batal</a>
                    <!-- Warna dan teks tombol berubah dinamis -->
                    <button type="submit" class="btn {{ $method == 'edit' ? 'btn-warning' : 'btn-primary' }}">
                        {{ $method == 'edit' ? 'Update Data' : 'Simpan Data' }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection