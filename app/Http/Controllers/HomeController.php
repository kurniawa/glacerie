<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        $reseps = Resep::limit(500)->orderBy('nama')->get();

        // dd($reseps);

        $data = [
            // 'goback' => 'home',
            // 'user_role' => $user_role,
            'menus' => Menu::get(),
            'route_now' => 'home',
            'profile_menus' => Menu::get_profile_menus(Auth::user()),
            'parent_route' => 'home',
            'back' => false,
            'backRoute' => null,
            'backRouteParams' => null,
            'spk_menus' => Menu::get_spk_menus(),
            // 'user' => Auth::user(),
            'reseps' => $reseps,
        ];

        return view('app', $data);
    }
}
