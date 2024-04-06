<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Menu;
use App\Models\Resep;
use App\Models\ResepBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller
{
    function create() {
        $data = [
            // 'goback' => 'home',
            // 'user_role' => $user_role,
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(Auth::user()),
            'parent_route' => 'home',
            'back' => true,
            'backRoute' => 'home',
            'backRouteParams' => null,
            'spk_menus' => Menu::get_spk_menus(),
            // 'user' => Auth::user(),
        ];
        return view('reseps.create', $data);
    }

    function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'porsi' => 'nullable',
            'satuan' => 'nullable',
        ]);

        $post = $request->post();
        // dd($post);

        // validasi bahan
        $data_bahan_valid = true;
        for ($i=0; $i < count($post['nama_bahan']); $i++) {
            if ($post['nama_bahan'][$i]) {
                if ($post['satuan_bahan'][$i]) {
                    if ($post['jumlah_bahan'][$i]) {

                    } else {
                        $data_bahan_valid = false;
                    }
                } else {
                    $data_bahan_valid = false;
                }
            }
        }
        // end - validasi bahan

        if (!$data_bahan_valid) {
            $request->validate(['error'=>'required'],['error.required'=>'-data bahan ada yang tidak valid-']);
        }

        $resep = Resep::create([
            'nama' => $post['nama'],
            'porsi' => $post['porsi'],
            'satuan' => $post['satuan'],
        ]);

        for ($i=0; $i < count($post['nama_bahan']); $i++) {
            // cek apakah bahan exist
            $bahan = Bahan::where('nama', $post['nama_bahan'][$i])->where('satuan', $post['satuan_bahan'][$i])->first();
            if (!$bahan) {
                if ($post['nama_bahan'][$i]) {
                    $bahan = Bahan::create([
                        'nama' => $post['nama_bahan'][$i],
                        'satuan' => $post['satuan_bahan'][$i],
                    ]);
                }
            }

            if ($bahan) {
                ResepBahan::create([
                    'resep_id' => $resep->id,
                    'bahan_id' => $bahan->id,
                    'satuan' => $post['satuan_bahan'][$i],
                    'jumlah' => $post['jumlah_bahan'][$i],
                ]);
            }
        }

        $feedback = [
            'success_' => '-Resep baru telah ditambahkan-'
        ];

        return redirect()->route('home')->with($feedback);
    }
}
