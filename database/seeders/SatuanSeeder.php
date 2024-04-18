<?php

namespace Database\Seeders;

use App\Models\RelasiAntarSatuan;
use App\Models\Satuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satuans = [
            ['nama' => 'kg', 'detailname' => 'kilogram'],
            ['nama' => 'g', 'detailname' => 'gram'],
            ['nama' => 'mg', 'detailname' => 'miligram'],
            ['nama' => 'l', 'detailname' => 'liter'],
            ['nama' => 'ml', 'detailname' => 'mililiter'],
            ['nama' => 'sdm', 'detailname' => 'sendok makan'],
            ['nama' => 'sdt', 'detailname' => 'sendok teh'],
            ['nama' => 'butir', 'detailname' => 'butir'],
        ];

        foreach ($satuans as $satuan) {
            Satuan::create([
                'nama' => $satuan['nama'],
                'detailname' => $satuan['detailname'],
            ]);
        }
        $relasi_antar_satuans = [
            ['satuan'=>'kg', 'relasi'=>'g', 'operasi'=>'perkalian', 'faktor'=>1000],
            ['satuan'=>'kg', 'relasi'=>'mg', 'operasi'=>'perkalian', 'faktor'=>1000],
            ['satuan'=>'kg', 'relasi'=>'mg', 'operasi'=>'perkalian', 'faktor'=>1000000],
            ['satuan'=>'g', 'relasi'=>'kg', 'operasi'=>'pembagian', 'faktor'=>1000],
            ['satuan'=>'g', 'relasi'=>'mg', 'operasi'=>'perkalian', 'faktor'=>1000],
            ['satuan'=>'g', 'relasi'=>'sdt', 'operasi'=>'perkalian', 'faktor'=>1000],
            ['satuan'=>'l', 'relasi'=>'ml', 'operasi'=>'perkalian', 'faktor'=>1000],
            ['satuan'=>'ml', 'relasi'=>'l', 'operasi'=>'pembagian', 'faktor'=>1000],
            ['satuan'=>'sdm', 'relasi'=>'kg', 'operasi'=>'perkalian', 'faktor'=>143, 'pembagi_faktor' => 10000],
            ['satuan'=>'sdm', 'relasi'=>'g', 'operasi'=>'perkalian', 'faktor'=>143, 'pembagi_faktor'=>10],
            ['satuan'=>'sdm', 'relasi'=>'mg', 'operasi'=>'perkalian', 'faktor'=>14300],
        ];

        foreach ($relasi_antar_satuans as $relasi_antar_satuan) {
            $satuan = Satuan::where('nama', $relasi_antar_satuan['satuan'])->first();
            $relasi = Satuan::where('nama', $relasi_antar_satuan['relasi'])->first();
            $pembagi_faktor = null;

            if (isset($relasi_antar_satuan['pembagi_faktor'])) {
                $pembagi_faktor = $relasi_antar_satuan['pembagi_faktor'];
            }

            RelasiAntarSatuan::create([
                'satuan_id' => $satuan->id,
                'relasi_id' => $relasi->id,
                'operasi' => $relasi_antar_satuan['operasi'],
                'faktor' => $relasi_antar_satuan['faktor'],
                'pembagi_faktor' => $pembagi_faktor,
            ]);
        }
    }
}
