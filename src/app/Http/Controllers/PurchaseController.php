<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Profile;
use App\Models\Buyer;

use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressChangeRequest;
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

    public function address_update(AddressChangeRequest $request){
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

    public function sold(PurchaseRequest $request){
        $menu_flg = "1";
        $user = Auth::user();
        $user_id = $user['id'];
        $items_id = $request['id'];
        $name = $request['name'];
        $payment = $request['payment'];
        $datetime = date("Y/m/d H:i:s");
        $value = $request['value'];
        if ($payment == 'コンビニ支払い'){
            $method = 'konbini';
        } elseif ($payment == 'クレジットカード払い'){
            $method = 'card';
        } elseif ($payment == '銀行振込'){
            $method = 'customer_balance';
        }
        return view('sold', compact('menu_flg','user_id','items_id','name','payment','datetime','value','method'));
    }

    public function success(Request $request){
        $menu_flg = "1";
        return view('success', compact('menu_flg'));
    }

    public function cancel(Request $request){
        $menu_flg = "1";
        buyer::where('id','=',$request['buyer_id'])->delete();
        return view('cancel', compact('menu_flg'));
    }
}
