<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Menu;
use App\Models\Resep;
use App\Models\ResepBahan;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller
{
    function create() {
        $reseps = Resep::select('id', 'nama_lengkap as label', 'nama_lengkap as value')->orderBy('nama')->get();
        $bahans = Bahan::select('id', 'nama as label', 'nama as value')->orderBy('nama')->get();
        $satuans = Satuan::select('id', 'nama as label', 'nama as value')->orderBy('nama')->get();

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
            'reseps'=>$reseps,
            'bahans'=>$bahans,
            'satuans'=>$satuans,
            // 'user' => Auth::user(),
        ];
        return view('reseps.create', $data);
    }

    function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'porsi' => 'nullable',
            'jumlah_bahan.*' => 'nullable|numeric', // karena bisa saja ada kolom kosong maka disini harus nullable dulu
            'cara_pembuatan' => 'nullable',
        ]);

        $post = $request->post();
        // dd($post);
        // is_nama_resep_exist?
        $nama_lengkap = $post['nama'];
        if ($post['porsi']) {
            $nama_lengkap .= " - " . $post['porsi'];
        }
        $is_nama_resep_exist = Resep::where('nama_lengkap', $nama_lengkap)->first();
        if ($is_nama_resep_exist) {
            $request->validate(['error'=>'required'],['error.required'=>'-Nama Resep sudah ada-']);
        }
        // end is_nama_resep_exist?

        // // validasi bahan
        // $data_bahan_valid = true;
        // for ($i=0; $i < count($post['nama_bahan']); $i++) {
        //     if ($post['nama_bahan'][$i]) {
        //         if ($post['satuan_bahan'][$i]) {
        //             if ($post['jumlah_bahan'][$i]) {

        //             } else {
        //                 $data_bahan_valid = false;
        //             }
        //         } else {
        //             $data_bahan_valid = false;
        //         }
        //     }
        // }
        // // end - validasi bahan

        // if (!$data_bahan_valid) {
        //     $request->validate(['error'=>'required'],['error.required'=>'-data bahan ada yang tidak valid-']);
        // }

        $resep = Resep::create([
            'nama' => $post['nama'],
            'porsi' => $post['porsi'],
            'nama_lengkap' => $nama_lengkap,
            'cara_pembuatan' => $post['cara_pembuatan'],
        ]);

        for ($i=0; $i < count($post['nama_bahan']); $i++) {
            if ($post['nama_bahan'][$i]) {
                // cek apakah bahan exist
                $bahan = Bahan::where('nama', $post['nama_bahan'][$i])->first();
                if (!$bahan) {
                    if ($post['nama_bahan'][$i]) {
                        $bahan = Bahan::create([
                            'nama' => $post['nama_bahan'][$i],
                        ]);
                    } else {
                        $request->validate(['error'=>'required'],['error.required'=>'-ada nama_bahan yang tidak valid-']);
                    }
                }

                // cek apakah satuan exist
                $satuan = Satuan::where('nama', $post['satuan_bahan'][$i])->first();
                if (!$satuan) {
                    if ($post['satuan_bahan'][$i]) {
                        $satuan = Satuan::create([
                            'nama' => $post['satuan_bahan'][$i],
                        ]);
                    } else {
                        $request->validate(['error'=>'required'],['error.required'=>'-ada satuan_bahan yang tidak valid-']);
                    }
                }

                ResepBahan::create([
                    'resep_id' => $resep->id,
                    'bahan_id' => $bahan->id,
                    'satuan' => $satuan->nama,
                    'jumlah' => $post['jumlah_bahan'][$i],
                ]);
            }
        }

        $feedback = [
            'success_' => '-Resep baru telah ditambahkan-'
        ];

        return redirect()->route('home')->with($feedback);
    }

    function show(Resep $resep) {

        // dd($resep->resep_bahans);

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
            'resep'=>$resep,
            // 'user' => Auth::user(),
        ];
        return view('reseps.show', $data);
    }

    function edit(Resep $resep) {
        $reseps = Resep::select('id', 'nama_lengkap as label', 'nama_lengkap as value')->orderBy('nama')->get();
        $bahans = Bahan::select('id', 'nama as label', 'nama as value')->orderBy('nama')->get();
        $satuans = Satuan::select('id', 'nama as label', 'nama as value')->orderBy('nama')->get();

        $data = [
            // 'goback' => 'home',
            // 'user_role' => $user_role,
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(Auth::user()),
            'parent_route' => 'home',
            'back' => true,
            'backRoute' => 'reseps.show',
            'backRouteParams' => $resep->id,
            'spk_menus' => Menu::get_spk_menus(),
            'resep'=>$resep,
            'reseps'=>$reseps,
            'bahans'=>$bahans,
            'satuans'=>$satuans,
            // 'user' => Auth::user(),
        ];
        return view('reseps.edit', $data);
    }

    function update(Resep $resep, Request $request) {
        $request->validate([
            'nama' => 'required',
            'porsi' => 'nullable',
            'jumlah_bahan.*' => 'nullable|numeric', // karena bisa saja ada kolom kosong maka disini harus nullable dulu
            'cara_pembuatan' => 'nullable',
        ]);

        $post = $request->post();
        // dd($post);

        $nama_lengkap = $post['nama'];
        if ($post['porsi']) {
            $nama_lengkap .= " - " . $post['porsi'];
        }

        // is_nama_resep_exist? tidak perlu validasi resep_exist karena ini adalah edit
        // $is_nama_resep_exist = Resep::where('nama_lengkap', $nama_lengkap)->first();
        // if ($is_nama_resep_exist) {
        //     $request->validate(['error'=>'required'],['error.required'=>'-Nama Resep sudah ada-']);
        // }
        // end is_nama_resep_exist?

        $resep->update([
            'nama' => $post['nama'],
            'porsi' => $post['porsi'],
            'nama_lengkap' => $nama_lengkap,
            'cara_pembuatan' => $post['cara_pembuatan'],
        ]);

        // Penghapusan resep_bahans sebelumnya
        $resep_bahans_old = ResepBahan::where('resep_id', $resep->id)->get();
        if (count($resep_bahans_old) !== 0) {
            foreach ($resep_bahans_old as $resep_bahan_old) {
                $resep_bahan_old->delete();
            }
        }

        for ($i=0; $i < count($post['nama_bahan']); $i++) {
            if ($post['nama_bahan'][$i]) {
                // cek apakah bahan exist
                $bahan = Bahan::where('nama', $post['nama_bahan'][$i])->first();
                if (!$bahan) {
                    if ($post['nama_bahan'][$i]) {
                        $bahan = Bahan::create([
                            'nama' => $post['nama_bahan'][$i],
                        ]);
                    } else {
                        $request->validate(['error'=>'required'],['error.required'=>'-ada nama_bahan yang tidak valid-']);
                    }
                }

                // cek apakah satuan exist
                $satuan = Satuan::where('nama', $post['satuan_bahan'][$i])->first();
                if (!$satuan) {
                    if ($post['satuan_bahan'][$i]) {
                        $satuan = Satuan::create([
                            'nama' => $post['satuan_bahan'][$i],
                            'detailname' => $post['satuan_bahan'][$i],
                        ]);
                    } else {
                        $request->validate(['error'=>'required'],['error.required'=>'-ada satuan_bahan yang tidak valid-']);
                    }
                }

                ResepBahan::create([
                    'resep_id' => $resep->id,
                    'bahan_id' => $bahan->id,
                    'satuan' => $satuan->nama,
                    'jumlah' => $post['jumlah_bahan'][$i],
                ]);
            }
        }

        $feedback = [
            'success_' => '-Data resep telah diupdate-'
        ];

        return back()->with($feedback);
    }

    function delete(Resep $resep) {
        $resep->delete();
        return redirect()->route('home')->with(['warnings_'=>'-Resep telah dihapus-']);
    }
}
