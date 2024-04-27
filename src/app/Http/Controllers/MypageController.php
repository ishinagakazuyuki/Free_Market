<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Item;
use App\Models\Buyer;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MypageController extends Controller
{
    public function mypage(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $profile = profile::where('user_id','=',$user['id'])->first();
        $env = env('APP_ENV');
        if($env == 'local') {
            if(!empty($profile['image'])){
                $url = $profile['image'];
            }else{
                $path = 'storage/images/default.jpg';
                $url = asset($path);
            }
        }else {
            if(!empty($profile['image'])){
                $url = $profile['image'];
            }else{
                $path = 'public/images/default.jpg';
                $url = Storage::disk('s3')->url($path);
            }
        }
        $item = item::where('user_id','=',$user['id'])->orderBy('items.id', 'desc')->get();
        $buy = buyer::join('items','buyers.items_id','items.id')->where('buyers.user_id','=',$user['id'])->where('buyers.pay_flg','=',0)
            ->orderBy('buyers.id', 'desc')->get();
        return view('mypage' , compact('menu_flg','profile','url','item','buy'));
    }

    public function profile(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $profile = profile::where('user_id','=',$user['id'])->first();
        $env = env('APP_ENV');
        if($env == 'local') {
            if(!empty($profile['image'])){
                $url = $profile['image'];
            }else{
                $path = 'storage/images/default.jpg';
                $url = asset($path);
            }
        }else {
            if(!empty($profile['image'])){
                $url = $profile['image'];
            }else{
                $path = 'public/images/default.jpg';
                $url = Storage::disk('s3')->url($path);
            }
        }
        return view('profile' , compact('menu_flg','profile','url'));
    }

    public function update(ProfileRequest $request){
        $menu_flg = "1";
        $user = Auth::user();
        $profile = profile::where('user_id','=',$user['id'])->first();
        $env = env('APP_ENV');
        if (empty($profile)){
            if (empty($request['image'])) {
                $url = null;
            } else {
                $file = $request->file('image');
                $filename = $user['id'] . "." . $file->getClientOriginalExtension();
                if($env == 'local') {
                    $path = Storage::disk('local')->putFileAs('public/images', $file, $filename);
                    $url = asset('storage/images/'.$profile['image']);
                } else {
                    $path = Storage::disk('s3')->putFileAs('public/images', $file, $filename);
                    $url = Storage::disk('s3')->url($path);
                }
            }
            $profiles = [
                'user_id' => $user['id'],
                'name' => $request['name'],
                'post_code' => $request['post_code'],
                'address' => $request['address'],
                'building' => $request['building'],
                'image' => $url,
            ];
            profile::create($profiles);
        } else {
            if (empty($request['image'])) {
                profile::where('user_id','=',$user['id'])->first()->update([
                    'name' => $request['name'],
                    'post_code' => $request['post_code'],
                    'address' => $request['address'],
                    'building' => $request['building'],
                ]);
            } else {
                $file = $request->file('image');
                $filename = $user['id'] . "." . $file->getClientOriginalExtension();
                if($env == 'local') {
                    $path = Storage::disk('local')->putFileAs('public/images', $file, $filename);
                    $url = asset('storage/images/'.$filename);
                } else {
                    $path = Storage::disk('s3')->putFileAs('public/images', $file, $filename);
                    $url = Storage::disk('s3')->url($path);
                }
                profile::where('user_id','=',$user['id'])->first()->update([
                    'name' => $request['name'],
                    'post_code' => $request['post_code'],
                    'address' => $request['address'],
                    'building' => $request['building'],
                    'image' => $url,
                ]);
            }
        }
        $profile = profile::where('user_id','=',$user['id'])->first();
        $url = $profile['image'];
        if($env == 'local') {
            if(!empty($profile['image'])){
                $url = $profile['image'];
            }else{
                $path = 'storage/images/default.jpg';
                $url = asset($path);
            }
        }else {
            if(!empty($profile['image'])){
                $url = $profile['image'];
            }else{
                $path = 'public/images/default.jpg';
                $url = Storage::disk('s3')->url($path);
            }
        }
        return view('profile' , compact('menu_flg','profile','url'));
    }
}
