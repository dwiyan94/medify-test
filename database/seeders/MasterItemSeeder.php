<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterItem; 
use Faker\Factory as Faker;

class MasterItemSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 100; $i++) {
            MasterItem::create([
                'kode'       => str_pad($i, 5, '0', STR_PAD_LEFT),
                'nama'       => $faker->words(2, true), // Tetap pakai Faker untuk nama barang acak
                'harga_beli' => $faker->numberBetween(5000, 500000),
                'laba'       => $faker->numberBetween(1000, 50000),
                'supplier'   => $this->getRandomSupplier(), // Memanggil fungsi Anda
                'jenis'      => $this->getRandomJenis(),    // Memanggil fungsi Anda
            ]);
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
}
