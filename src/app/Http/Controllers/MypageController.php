<?php

namespace App\Http\Controllers;

use App\Models\profile;
use App\Models\item;
use App\Models\buyer;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class MypageController extends Controller
{
    public function mypage(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $username = profile::where('user_id','=',$user['id'])->first();
        $item = item::where('user_id','=',$user['id'])->orderBy('items.id', 'desc')->get();
        $buy = buyer::join('items','buyers.items_id','items.id')->where('buyers.user_id','=',$user['id'])->orderBy('buyers.id', 'desc')->get();
        return view('mypage' , compact('menu_flg','username','item','buy'));
    }
    public function profile(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $profile = profile::where('user_id','=',$user['id'])->first();
        return view('profile' , compact('menu_flg','profile'));
    }
    public function update(ProfileRequest $request){
        $menu_flg = "1";
        $user = Auth::user();
        if (empty($request['image'])) {
            $filename = null;
        } else {
            $file = $request->file('image');
            $filename = $user['id'] . "." . $file->getClientOriginalExtension();
        }
        $profile = profile::where('user_id','=',$user['id'])->first();
        if (empty($profile)){
            if (empty($request['image'])) {
                $profiles = [
                    'user_id' => $user['id'],
                    'name' => $request['name'],
                    'post_code' => $request['post_code'],
                    'address' => $request['address'],
                    'building' => $request['building'],
                ];
                profile::create($profiles);
            } else {
                $file = $request->file('image');
                $filename = $user['id'] . "." . $file->getClientOriginalExtension();
                $path = $file->storeAs('images', $filename, 'public');
                $profiles = [
                    'user_id' => $user['id'],
                    'name' => $request['name'],
                    'post_code' => $request['post_code'],
                    'address' => $request['address'],
                    'building' => $request['building'],
                    'image' => $filename,
                ];
                profile::create($profiles);
            }
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
                $path = $file->storeAs('images', $filename, 'public');
                profile::where('user_id','=',$user['id'])->first()->update([
                    'name' => $request['name'],
                    'post_code' => $request['post_code'],
                    'address' => $request['address'],
                    'building' => $request['building'],
                    'image' => $filename,
                ]);
            }
        }
        $profile = profile::where('user_id','=',$user['id'])->first();
        return view('profile' , compact('menu_flg','profile'));
    }
}
