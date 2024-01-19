<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request){
        $menu_flg = "1";
        return view('index' , compact('menu_flg'));
    }
    public function sell(Request $request){
        $menu_flg = "1";
        return view('sell' , compact('menu_flg'));
    }
}
