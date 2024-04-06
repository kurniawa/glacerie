<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Menu;
use App\Models\RelasiAntarSatuan;
use App\Models\Resep;
use App\Models\ResepBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalculatorController extends Controller
{
    function index() {
        $reseps = Resep::orderBy('nama')->select('id', 'nama as label', 'nama as value', 'porsi', 'satuan')->get();
        $bahans = Bahan::orderBy('nama')->get();
        $resep_bahans = ResepBahan::all();
        // $rass = RelasiAntarSatuan::all();

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
            'reseps' => $reseps,
            'bahans' => $bahans,
            'resep_bahans' => $resep_bahans,
            // 'rass' => $rass,
        ];
        return view('calculator.index', $data);
    }
}
