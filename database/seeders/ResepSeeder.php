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
            ['nama' => 'Kue Salju Lebaran', 'porsi' => '4 Toples'],
            ['nama' => 'Kue Nastar', 'porsi' => '1 Toples'],
            ['nama' => 'Marble Cake', 'porsi' => '2 Loyang'],
            ['nama' => 'Quiche', 'porsi' => '9 pcs'],
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
            ['resep_id' => '1', 'nama_bahan' => 'Tepung Terigu', 'jumlah'=> '1', 'satuan'=> 'kg', 'jumlah_1' => '1', 'satuan_1' => 'kg', 'jumlah_2' => '1000', 'satuan_2' => 'g'],
            ['resep_id' => '1', 'nama_bahan' => 'Mentega', 'jumlah'=> '0.5', 'satuan'=> 'kg', 'jumlah_1' => '0.5', 'satuan_1' => 'kg', 'jumlah_2' => '1000', 'satuan_2' => 'g'],
            ['resep_id' => '1', 'nama_bahan' => 'Rumbutter', 'jumlah' => '28.35', 'satuan' => 'ons', 'jumlah_2' => '28.35', 'satuan_2' => 'ons'],
            ['resep_id' => '1', 'nama_bahan' => 'Telur', 'jumlah' => '2', 'satuan' => 'butir', 'jumlah_1' => '2', 'satuan_1' => 'butir'],
            ['resep_id' => '1', 'nama_bahan' => 'Gula Halus', 'jumlah' => '2', 'satuan' => 'sdm', 'jumlah_1' => '2', 'jumlah_1' => '0.0286', 'satuan_1' => 'kg', 'jumlah_2' => '28.6', 'satuan_2' => 'g', 'jumlah_3' => '28600', 'satuan_3' => 'mg', 'jumlah_4' => '2', 'satuan_4' => 'sdm'],
            ['resep_id' => '1', 'nama_bahan' => 'Susu Bubuk Full Cream', 'jumlah' => '2', 'satuan' => 'sdm', 'jumlah_1' => '0.0286', 'satuan_1' => 'kg', 'jumlah_2' => '28.6', 'satuan_2' => 'g', 'jumlah_3' => '28600', 'satuan_3' => 'mg', 'jumlah_4' => '2', 'satuan_4' => 'sdm'],
            // Kue Lapis Pandan
            ['resep_id' => '2', 'nama_bahan' => 'Tepung Terigu', 'jumlah' => '250', 'satuan' => 'g', 'jumlah_1' => '0.25', 'satuan_1' => 'kg', 'jumlah_2' => '250', 'satuan_2' => 'g'],
            ['resep_id' => '2', 'nama_bahan' => 'Tepung Maizena', 'jumlah' => '25', 'satuan' => 'g', 'jumlah_1' => '0.025', 'satuan_1' => 'kg', 'jumlah_2' => '25', 'satuan_2' => 'g'],
            ['resep_id' => '2', 'nama_bahan' => 'Margarin', 'jumlah' => '25', 'satuan' => 'g', 'jumlah_1' => '25', 'satuan_1' => 'g', 'jumlah_2' => '0.025', 'satuan_2' => 'kg'],
            ['resep_id' => '2', 'nama_bahan' => 'Mentega', 'jumlah' => '50', 'satuan' => 'g', 'jumlah_1' => '0.05', 'satuan_1' => 'kg', 'jumlah_2' => '50', 'satuan_2' => 'g'],
            ['resep_id' => '2', 'nama_bahan' => 'Telur', 'jumlah' => '3', 'satuan' => 'butir', 'jumlah_1' => '3', 'satuan_1' => 'butir'],
            ['resep_id' => '2', 'nama_bahan' => 'Susu Bubuk', 'jumlah' => '26', 'satuan' => 'g', 'jumlah_2' => '26', 'satuan_2' => 'g'],
            ['resep_id' => '2', 'nama_bahan' => 'Gula Halus', 'jumlah' => '25', 'satuan' => 'g', 'jumlah_2' => '25', 'satuan_2' => 'g'],
            // Marble Cake
            ['resep_id' => '3', 'nama_bahan' => 'Dark Chocolate', 'jumlah' => '140', 'satuan' => 'g'],
            ['resep_id' => '3', 'nama_bahan' => 'Tepung Terigu Segitiga Biru', 'jumlah' => '295', 'satuan' => 'g'],
            ['resep_id' => '3', 'nama_bahan' => 'Mentega Wijsman', 'jumlah' => '85', 'satuan' => 'g'],
            ['resep_id' => '3', 'nama_bahan' => 'Mentega Anchor', 'jumlah' => '85', 'satuan' => 'g'],
            ['resep_id' => '3', 'nama_bahan' => 'Gula Pasir', 'jumlah' => '250', 'satuan' => 'g'],
            ['resep_id' => '3', 'nama_bahan' => 'Telur Ayam', 'jumlah' => '4', 'satuan' => 'butir'],
            ['resep_id' => '3', 'nama_bahan' => 'Yoghurt', 'jumlah' => '80', 'satuan' => 'g'],
            ['resep_id' => '3', 'nama_bahan' => 'Susu', 'jumlah' => '120', 'satuan' => 'g'],
            ['resep_id' => '3', 'nama_bahan' => 'Baking Powder', 'jumlah' => '2.5', 'satuan' => 'sdt'],
            ['resep_id' => '3', 'nama_bahan' => 'Baking Soda', 'jumlah' => '0.5', 'satuan' => 'sdm'],
            ['resep_id' => '3', 'nama_bahan' => 'Garam', 'jumlah' => '1', 'satuan' => 'secukupnya'],
            // Quiche
            ['resep_id' => '4', 'nama_bahan' => 'Whipped Cream', 'jumlah' => '200', 'satuan' => 'g'],
            ['resep_id' => '4', 'nama_bahan' => 'Telur Ayam', 'jumlah' => '2', 'satuan' => 'butir'],
            ['resep_id' => '4', 'nama_bahan' => 'Susu', 'jumlah' => '50', 'satuan' => 'ml'],
            ['resep_id' => '4', 'nama_bahan' => 'Garam', 'jumlah' => '1', 'satuan' => 'secukupnya'],
            ['resep_id' => '4', 'nama_bahan' => 'Gula Pasir', 'jumlah' => '1', 'satuan' => 'secukupnya'],
            ['resep_id' => '4', 'nama_bahan' => 'Lada', 'jumlah' => '1', 'satuan' => 'secukupnya'],
        ];

        for ($i=0; $i < count($bahans); $i++) {
            $detailname = null;
            $othername = null;
            // $satuan_1 = null;
            // $satuan_2 = null;
            // $satuan_3 = null;
            // $satuan_4 = null;
            // $satuan_5 = null;

            if (isset($bahans[$i]['detailname'])) {
                $detailname = $bahans[$i]['detailname'];
            }
            if (isset($bahans[$i]['othername'])) {
                $othername = $bahans[$i]['othername'];
            }
            // if (isset($bahans[$i]['satuan_1'])) {
            //     $satuan_1 = $bahans[$i]['satuan_1'];
            // }
            // if (isset($bahans[$i]['satuan_2'])) {
            //     $satuan_2 = $bahans[$i]['satuan_2'];
            // }
            // if (isset($bahans[$i]['satuan_3'])) {
            //     $satuan_3 = $bahans[$i]['satuan_3'];
            // }
            // if (isset($bahans[$i]['satuan_4'])) {
            //     $satuan_4 = $bahans[$i]['satuan_4'];
            // }
            // if (isset($bahans[$i]['satuan_5'])) {
            //     $satuan_5 = $bahans[$i]['satuan_5'];
            // }

            Bahan::create([
                'nama' => $bahans[$i]['nama'],
                'detailname' => $detailname,
                'othername' => $othername,
                // 'satuan_1' => $satuan_1,
                // 'satuan_2' => $satuan_2,
                // 'satuan_3' => $satuan_3,
                // 'satuan_4' => $satuan_4,
                // 'satuan_5' => $satuan_5,
            ]);
        }

        for ($i=0; $i < count($reseps); $i++) {
            Resep::create([
                'nama' => $reseps[$i]['nama'],
                'porsi' => $reseps[$i]['porsi'],
                'nama_lengkap' => $reseps[$i]['nama'] . " " . $reseps[$i]['porsi'],
            ]);

        }

        for ($i=0; $i < count($resep_bahans); $i++) {
            // dump($resep_bahans[$i]['nama_bahan']);
            $bahan = Bahan::where('nama', $resep_bahans[$i]['nama_bahan'])->first();
            if (!$bahan) {
                $bahan = Bahan::where('detailname', $resep_bahans[$i]['nama_bahan'])->first();
                if (!$bahan) {
                    $bahan = Bahan::create([
                        'nama' => $resep_bahans[$i]['nama_bahan'],
                    ]);
                }
            }
            $keterangan = null;
            if (isset($resep_bahans[$i]['keterangan'])) {
                $keterangan = $resep_bahans[$i]['keterangan'];
            }

            // $satuan_1 = $bahan->satuan_1;
            // $satuan_2 = $bahan->satuan_2;
            // $satuan_3 = $bahan->satuan_3;
            // $satuan_4 = $bahan->satuan_4;
            // $satuan_5 = $bahan->satuan_5;

            // if (isset($resep_bahans[$i]['satuan_1'])) {
            //     $satuan_1 = $resep_bahans[$i]['satuan_1'];
            // }
            // if (isset($resep_bahans[$i]['satuan_2'])) {
            //     $satuan_2 = $resep_bahans[$i]['satuan_2'];
            // }
            // if (isset($resep_bahans[$i]['satuan_3'])) {
            //     $satuan_3 = $resep_bahans[$i]['satuan_3'];
            // }
            // if (isset($resep_bahans[$i]['satuan_4'])) {
            //     $satuan_4 = $resep_bahans[$i]['satuan_4'];
            // }
            // if (isset($resep_bahans[$i]['satuan_5'])) {
            //     $satuan_5 = $resep_bahans[$i]['satuan_5'];
            // }

            // $jumlah_1 = null;
            // $jumlah_2 = null;
            // $jumlah_3 = null;
            // $jumlah_4 = null;
            // $jumlah_5 = null;
            // if (isset($resep_bahans[$i]['jumlah_1'])) {
            //     $jumlah_1 = $resep_bahans[$i]['jumlah_1'];
            // }
            // if (isset($resep_bahans[$i]['jumlah_2'])) {
            //     $jumlah_2 = $resep_bahans[$i]['jumlah_2'];
            // }
            // if (isset($resep_bahans[$i]['jumlah_3'])) {
            //     $jumlah_3 = $resep_bahans[$i]['jumlah_3'];
            // }
            // if (isset($resep_bahans[$i]['jumlah_4'])) {
            //     $jumlah_4 = $resep_bahans[$i]['jumlah_4'];
            // }
            // if (isset($resep_bahans[$i]['jumlah_5'])) {
            //     $jumlah_5 = $resep_bahans[$i]['jumlah_5'];
            // }


            ResepBahan::create([
                'resep_id' => $resep_bahans[$i]['resep_id'],
                'bahan_id' => $bahan->id,
                'jumlah' => $resep_bahans[$i]['jumlah'],
                'satuan' => $resep_bahans[$i]['satuan'],
                // 'satuan_1' => $satuan_1,
                // 'satuan_2' => $satuan_2,
                // 'satuan_3' => $satuan_3,
                // 'satuan_4' => $satuan_4,
                // 'satuan_5' => $satuan_5,
                // 'jumlah_1' => $jumlah_1,
                // 'jumlah_2' => $jumlah_2,
                // 'jumlah_3' => $jumlah_3,
                // 'jumlah_4' => $jumlah_4,
                // 'jumlah_5' => $jumlah_5,
                'keterangan' => $keterangan,
            ]);
        }
    }
}
