<?php

namespace App\Exports;

use App\Models\MasterItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MasterItemsExport implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;

    // Mengambil data dengan Eager Loading relasi kategoris
    public function collection()
    {
        return MasterItem::with('kategoris')->get();
    }

    // Mendefinisikan baris judul (Header) sesuai instruksi
    public function headings(): array
    {
        return [
            'No',
            'Nama kategori (terpisah koma)',
            'Nama items',
            'Nama supplier',
            'Harga',
            'Laba',
            'Harga jual'
        ];
    }

    // Memetakan isi data per baris
    public function map($item): array
    {
        $this->rowNumber++;
        
        // Menggabungkan nama kategori dengan koma
        $kategori_string = $item->kategoris->pluck('nama')->implode(', ');
        
        // Kalkulasi harga jual
        $harga_jual = $item->harga_beli + ($item->harga_beli * $item->laba / 100);

        return [
            $this->rowNumber,          // 1. No[cite: 9]
            $kategori_string,          // 2. Nama kategori[cite: 9]
            $item->nama,               // 3. Nama items[cite: 9]
            $item->supplier,           // 4. Nama supplier[cite: 9]
            $item->harga_beli,         // 5. Harga[cite: 9]
            $item->laba,               // 6. Laba[cite: 9]
            round($harga_jual)         // 7. Harga jual[cite: 9]
        ];
    }
}