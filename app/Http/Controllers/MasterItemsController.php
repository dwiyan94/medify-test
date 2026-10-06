<?php

namespace App\Http\Controllers;

use App\Models\MasterItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Kategori; 
use App\Exports\MasterItemsExport; 
use Maatwebsite\Excel\Facades\Excel; 

class MasterItemsController extends Controller
{
    public function index()
    {
        return view('master_items.index.index');
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;
        $hargamin = $request->hargamin;
        $hargamax = $request->hargamax;

        $data_search = MasterItem::query();

        if (!empty($kode)) {
            $data_search->where('kode', $kode);
        }
        if (!empty($nama)) {
            $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        }
        
        // Dipisah agar tidak error jika salah satu kolom harga dikosongkan
        if (!empty($hargamin)) {
            $data_search->where('harga_beli', '>=', $hargamin);
        }
        if (!empty($hargamax)) {
            $data_search->where('harga_beli', '<=', $hargamax);
        }

        $data_search = $data_search->select('kode', 'nama', 'jenis', 'harga_beli', 'laba', 'supplier', 'image')->orderBy('id')->get();

        // Sisipkan proses enkripsi di sini sebelum dikembalikan ke JavaScript
        foreach ($data_search as $item) {
            $item->encrypted_kode = bin2hex($item->kode);
        }

        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function formView($method, $id = 0)
    {
        $data['method'] = $method;

        $data['semua_kategori'] = Kategori::all();

        if ($method == 'edit') {
            // Mengambil data jika sedang edit
            $data['item'] = MasterItem::with('kategoris')->find($id);
        } else {
            // Mengosongkan data jika form tambah baru
            $data['item'] = null; 
        }

        // Mengarah ke SATU file blade saja
        return view('master_items.form.index', $data);
    }

    public function singleView($encrypted_kode)
    {
        try {
            $kode_asli = hex2bin($encrypted_kode); 
            
        } catch (\Exception $e) {
            return redirect('master-items')->with('error', 'Format URL tidak valid atau telah dimanipulasi.');
        }

        $item = MasterItem::where('kode', $kode_asli)->first();
        
        if (!$item) {
            return redirect('master-items')->with('error', 'Data master item tidak ditemukan.');
        }

        $data['data'] = $item;
        return view('master_items.single.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        if ($method == 'new') {
            $data_item = new MasterItem;
            $kode = MasterItem::count('id');
            $kode = $kode + 1;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);
            sleep(3);
        } else {
            $data_item = MasterItem::find($id);
            $kode = $data_item->kode;
        }

        $data_item->nama = $request->nama;
        $data_item->harga_beli = $request->harga_beli;
        $data_item->laba = $request->laba;
        $data_item->kode = $kode;
        $data_item->supplier = $request->supplier;
        $data_item->jenis = $request->jenis;
        
        // --- LOGIKA UPLOAD GAMBAR ---
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            // Membuat nama file unik (Contoh: 1696560000_ITM-001.jpg)
            $nama_file = time() . '_' . $kode . '.' . $file->getClientOriginalExtension();
            
            // Memindahkan file secara fisik ke folder public/images/master_items
            $file->move(public_path('images/master_items'), $nama_file);
            
            // Menyimpan nama file tersebut ke dalam kolom database
            $data_item->image = $nama_file;
        }

        $data_item->save();

        // Setelah $data_item->save();
        if ($request->has('kategori_ids')) {
            $data_item->kategoris()->sync($request->kategori_ids);
        }

        return redirect('master-items');
    }

    public function delete($id)
    {
        MasterItem::find($id)->delete();
        return redirect('master-items');
    }

    public function updateRandomData()
    {
        $data = MasterItem::get();
        foreach($data as $item)
        {
            $kode = $item->id;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);

            $item->harga_beli = rand(100,1000000);
            $item->laba = rand(10,99);
            $item->kode = $kode;
            $item->supplier = $this->getRandomSupplier();
            $item->jenis = $this->getRandomJenis();
            $item->save();
        }
    }

    private function getRandomSupplier()
    {
        $array = ['Tokopaedi','Bukulapuk','TokoBagas','E Commurz','Blublu'];
        $random = rand(0,4);
        return $array[$random];
    }

    private function getRandomJenis()
    {
        $array = ['Obat','Alkes','Matkes','Umum','ATK'];
        $random = rand(0,4);
        return $array[$random];
    }

    public function exportExcel()
    {
        return Excel::download(new MasterItemsExport, 'Data_Master_Items.xlsx');
    }
}
