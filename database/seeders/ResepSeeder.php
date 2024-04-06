<?php

namespace Database\Seeders;

use App\Models\Bahan;
use App\Models\Resep;
use App\Models\ResepBahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reseps = [
            ['nama' => 'Kue Salju Lebaran', 'porsi' => '4', 'satuan' => 'toples'],
            ['nama' => 'Kue Nastar', 'porsi' => '1', 'satuan' => 'toples'],
        ];

        $bahans = [
            ['nama' => 'Gula Halus', 'satuan_1'=>'kg', 'satuan_2'=>'g', 'satuan_3'=>'mg', 'satuan_4' => 'sdm'],
            ['nama' => 'Margarin', 'satuan_1'=>'kg', 'satuan_2'=>'g', 'satuan_3'=>'mg'],
            ['nama' => 'Mentega', 'detailname' => 'Mentega/Butter', 'othername' => 'Butter', 'satuan_1'=>'kg', 'satuan_2'=>'g', 'satuan_3'=>'mg'],
            ['nama' => 'Rumbutter', 'satuan_1'=>'kg', 'satuan_2'=>'g', 'satuan_3'=>'mg'],
            ['nama' => 'Susu Bubuk', 'detailname' => 'Susu Bubuk Full Cream', 'satuan_1'=>'kg', 'satuan_2'=>'g', 'satuan_3'=>'mg', 'satuan_4'=>'sdm'],
            ['nama' => 'Telur', 'satuan_1' => 'butir'],
            ['nama' => 'Tepung Maizena', 'satuan_1'=>'kg', 'satuan_2'=>'g', 'satuan_3'=>'mg'],
            ['nama' => 'Tepung Terigu', 'satuan_1'=>'kg', 'satuan_2'=>'g', 'satuan_3'=>'mg'],
        ];

        $resep_bahans = [
            // Kue Salju Lebaran
            ['resep_id' => '1', 'nama_bahan' => 'Tepung Terigu', 'jumlah_1' => '1', 'satuan_1' => 'kg', 'jumlah_2' => '1000', 'satuan_2' => 'g'],
            ['resep_id' => '1', 'nama_bahan' => 'Mentega', 'jumlah_1' => '0.5', 'satuan_1' => 'kg', 'jumlah_2' => '1000', 'satuan_2' => 'g'],
            ['resep_id' => '1', 'nama_bahan' => 'Rumbutter', 'jumlah_2' => '28.35', 'satuan_2' => 'ons'],
            ['resep_id' => '1', 'nama_bahan' => 'Telur', 'jumlah_1' => '2', 'satuan_1' => 'butir'],
            ['resep_id' => '1', 'nama_bahan' => 'Gula Halus', 'jumlah_1' => '2', 'jumlah_1' => '0.0286', 'satuan_1' => 'kg', 'jumlah_2' => '28.6', 'satuan_2' => 'g', 'jumlah_3' => '28600', 'satuan_3' => 'mg', 'jumlah_4' => '2', 'satuan_4' => 'sdm'],
            ['resep_id' => '1', 'nama_bahan' => 'Susu Bubuk Full Cream', 'jumlah_1' => '0.0286', 'satuan_1' => 'kg', 'jumlah_2' => '28.6', 'satuan_2' => 'g', 'jumlah_3' => '28600', 'satuan_3' => 'mg', 'jumlah_4' => '2', 'satuan_4' => 'sdm'],
            // Kue Lapis Pandan
            ['resep_id' => '2', 'nama_bahan' => 'Tepung Terigu', 'jumlah_1' => '0.25', 'satuan_1' => 'kg', 'jumlah_2' => '250', 'satuan_2' => 'g'],
            ['resep_id' => '2', 'nama_bahan' => 'Tepung Maizena', 'jumlah_1' => '0.025', 'satuan_1' => 'kg', 'jumlah_2' => '25', 'satuan_2' => 'g'],
            ['resep_id' => '2', 'nama_bahan' => 'Margarin','jumlah_1' => '25', 'satuan_1' => 'kg', 'jumlah_2' => '0.025', 'satuan_2' => 'g'],
            ['resep_id' => '2', 'nama_bahan' => 'Mentega','jumlah_1' => '0.05', 'satuan_1' => 'kg', 'jumlah_2' => '50', 'satuan_2' => 'g'],
            ['resep_id' => '2', 'nama_bahan' => 'Telur', 'jumlah_1' => '3', 'satuan_1' => 'butir'],
            ['resep_id' => '2', 'nama_bahan' => 'Susu Bubuk', 'jumlah_2' => '26', 'satuan_2' => 'g'],
            ['resep_id' => '2', 'nama_bahan' => 'Gula Halus', 'jumlah_2' => '25', 'satuan_2' => 'g'],
        ];

        for ($i=0; $i < count($bahans); $i++) {
            $detailname = null;
            $othername = null;
            $satuan_1 = null;
            $satuan_2 = null;
            $satuan_3 = null;
            $satuan_4 = null;
            $satuan_5 = null;

            if (isset($bahans[$i]['detailname'])) {
                $detailname = $bahans[$i]['detailname'];
            }
            if (isset($bahans[$i]['othername'])) {
                $othername = $bahans[$i]['othername'];
            }
            if (isset($bahans[$i]['satuan_1'])) {
                $satuan_1 = $bahans[$i]['satuan_1'];
            }
            if (isset($bahans[$i]['satuan_2'])) {
                $satuan_2 = $bahans[$i]['satuan_2'];
            }
            if (isset($bahans[$i]['satuan_3'])) {
                $satuan_3 = $bahans[$i]['satuan_3'];
            }
            if (isset($bahans[$i]['satuan_4'])) {
                $satuan_4 = $bahans[$i]['satuan_4'];
            }
            if (isset($bahans[$i]['satuan_5'])) {
                $satuan_5 = $bahans[$i]['satuan_5'];
            }

            Bahan::create([
                'nama' => $bahans[$i]['nama'],
                'detailname' => $detailname,
                'othername' => $othername,
                'satuan_1' => $satuan_1,
                'satuan_2' => $satuan_2,
                'satuan_3' => $satuan_3,
                'satuan_4' => $satuan_4,
                'satuan_5' => $satuan_5,
            ]);
        }

        for ($i=0; $i < count($reseps); $i++) {
            Resep::create([
                'nama' => $reseps[$i]['nama'],
                'porsi' => $reseps[$i]['porsi'],
                'satuan' => $reseps[$i]['satuan'],
            ]);

        }

        for ($i=0; $i < count($resep_bahans); $i++) {
            // dump($resep_bahans[$i]['nama_bahan']);
            $bahan = Bahan::where('nama', $resep_bahans[$i]['nama_bahan'])->first();
            if (!$bahan) {
                $bahan = Bahan::where('detailname', $resep_bahans[$i]['nama_bahan'])->first();
            }
            $keterangan = null;
            if (isset($resep_bahans[$i]['keterangan'])) {
                $keterangan = $resep_bahans[$i]['keterangan'];
            }

            $satuan_1 = $bahan->satuan_1;
            $satuan_2 = $bahan->satuan_2;
            $satuan_3 = $bahan->satuan_3;
            $satuan_4 = $bahan->satuan_4;
            $satuan_5 = $bahan->satuan_5;

            if (isset($resep_bahans[$i]['satuan_1'])) {
                $satuan_1 = $resep_bahans[$i]['satuan_1'];
            }
            if (isset($resep_bahans[$i]['satuan_2'])) {
                $satuan_2 = $resep_bahans[$i]['satuan_2'];
            }
            if (isset($resep_bahans[$i]['satuan_3'])) {
                $satuan_3 = $resep_bahans[$i]['satuan_3'];
            }
            if (isset($resep_bahans[$i]['satuan_4'])) {
                $satuan_4 = $resep_bahans[$i]['satuan_4'];
            }
            if (isset($resep_bahans[$i]['satuan_5'])) {
                $satuan_5 = $resep_bahans[$i]['satuan_5'];
            }

            $jumlah_1 = null;
            $jumlah_2 = null;
            $jumlah_3 = null;
            $jumlah_4 = null;
            $jumlah_5 = null;
            if (isset($resep_bahans[$i]['jumlah_1'])) {
                $jumlah_1 = $resep_bahans[$i]['jumlah_1'];
            }
            if (isset($resep_bahans[$i]['jumlah_2'])) {
                $jumlah_2 = $resep_bahans[$i]['jumlah_2'];
            }
            if (isset($resep_bahans[$i]['jumlah_3'])) {
                $jumlah_3 = $resep_bahans[$i]['jumlah_3'];
            }
            if (isset($resep_bahans[$i]['jumlah_4'])) {
                $jumlah_4 = $resep_bahans[$i]['jumlah_4'];
            }
            if (isset($resep_bahans[$i]['jumlah_5'])) {
                $jumlah_5 = $resep_bahans[$i]['jumlah_5'];
            }


            ResepBahan::create([
                'resep_id' => $resep_bahans[$i]['resep_id'],
                'bahan_id' => $bahan->id,
                'satuan_1' => $satuan_1,
                'satuan_2' => $satuan_2,
                'satuan_3' => $satuan_3,
                'satuan_4' => $satuan_4,
                'satuan_5' => $satuan_5,
                'jumlah_1' => $jumlah_1,
                'jumlah_2' => $jumlah_2,
                'jumlah_3' => $jumlah_3,
                'jumlah_4' => $jumlah_4,
                'jumlah_5' => $jumlah_5,
                'keterangan' => $keterangan,
            ]);
        }
    }
}
