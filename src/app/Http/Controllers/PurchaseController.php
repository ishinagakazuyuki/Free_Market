<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\profile;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function purchase(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $item = item::where('id','=',$request['id'])->first();
        $profile = profile::where('user_id','=',$user['id'])->first();
        $payment = "コンビニ支払い";
        return view('purchase' , compact('menu_flg','item','profile','payment'));
    }
    public function payment(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $item = item::where('id','=',$request['id'])->first();
        $profile = profile::where('user_id','=',$user['id'])->first();
        return view('payment' , compact('menu_flg','item','profile'));
    }
    public function payment_update(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $item = item::where('id','=',$request['id'])->first();
        $profile = profile::where('user_id','=',$user['id'])->first();
        $payment = $request['payment'];
        return view('purchase' , compact('menu_flg','item','profile','payment'));
    }
    public function address(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $item = item::where('id','=',$request['id'])->first();
        $profile = profile::where('user_id','=',$user['id'])->first();
        $payment = $request['payment'];
        return view('address' , compact('menu_flg','item','profile','payment'));
    }
    public function address_update(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $profile = profile::where('user_id','=',$user['id'])->first();
        if (empty($profile)){
            $profiles = [
                'user_id' => $user['id'],
                'name' => 'ユーザー',
                'post_code' => $request['post_code'],
                'address' => $request['address'],
                'building' => $request['building'],
            ];
            profile::create($profiles);
        } else {
            profile::where('user_id','=',$user['id'])->first()->update([
                'post_code' => $request['post_code'],
                'address' => $request['address'],
                'building' => $request['building'],
            ]);
        }
        $item = item::where('id','=',$request['id'])->first();
        $profile = profile::where('user_id','=',$user['id'])->first();
        $payment = $request['payment'];
        return view('purchase' , compact('menu_flg','item','profile','payment'));
    }
}
