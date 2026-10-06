<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class KategoriController extends Controller
{
    // Halaman Index dengan Filter
    public function index(Request $request)
    {
        $query = Kategori::query();

        // Filter berdasarkan nama dan kode
        if ($request->filled('kode')) {
            $query->where('kode', 'LIKE', '%' . $request->kode . '%');
        }
        if ($request->filled('nama')) {
            $query->where('nama', 'LIKE', '%' . $request->nama . '%');
        }

        $kategoris = $query->get();
        return view('kategori.index', compact('kategoris'));
    }

    // Halaman View Single Kategori
    public function show($id)
    {
        // Menggunakan with('masterItems') adalah penerapan EAGER LOADING
        $kategori = Kategori::with('masterItems')->findOrFail($id);
        
        return view('kategori.show', compact('kategori'));
    }

    // Fungsi untuk menampilkan form
    public function formView($method, $id = 0)
    {
        $data['method'] = $method;

        if ($method == 'edit') {
            $data['kategori'] = Kategori::findOrFail($id);
        } else {
            $data['kategori'] = null;
        }

        return view('kategori.form', $data);
    }

    // Fungsi untuk memproses penyimpanan atau update data
    public function formSubmit(Request $request, $method, $id = 0)
    {
        if ($method == 'new') {
            $kategori = new Kategori;
            
            // Auto-generate Kode Kategori (Contoh: KAT-001)
            $count = Kategori::count('id') + 1;
            $kode = 'KAT-' . str_pad($count, 3, '0', STR_PAD_LEFT);
        } else {
            $kategori = Kategori::findOrFail($id);
            $kode = $kategori->kode;
        }

        $kategori->kode = $kode;
        $kategori->nama = $request->nama;
        $kategori->save();

        return redirect('kategori')->with('success', 'Data kategori berhasil disimpan.');
    }

    public function delete($id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete(); 

        return redirect('kategori')->with('success', 'Data kategori berhasil dihapus.');
    }

    public function printPdf($id)
    {
        // Ambil data kategori beserta relasi itemnya (Eager Loading)
        $kategori = Kategori::with('masterItems')->findOrFail($id);

        // Load view khusus PDF dan passing data
        $pdf = Pdf::loadView('kategori.pdf', compact('kategori'));

        // Kembalikan response berupa file PDF yang otomatis ter-download
        return $pdf->download('Kategori_' . $kategori->kode . '.pdf');
    }
}
