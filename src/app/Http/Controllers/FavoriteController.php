<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Item;
use App\Models\Mylist;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Permission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favorite(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $favorite = mylist::where('user_id','=',$user['id'])->where('items_id','=',$request['id'])->first();
        if (empty($favorite)){
            $favorites = [
                'user_id' => $user['id'],
                'items_id' => $request['id'],
            ];
            mylist::create($favorites);
        }else {
            $favorite->delete();
        };
        $item = item::where('id','=',$request['id'])->first();
        $brand = brand::where('id','=',$item['brands_id'])->first();
        $category = category::where('id','=',$item['categories_id'])->first();
        $condition = condition::where('id','=',$item['conditions_id'])->first();
        $favorite = mylist::where('items_id','=',$request['id'])->count();
        $comment = comment::where('items_id','=',$request['id'])->count();
        return view('detail' , compact('menu_flg','item','brand','category','condition','favorite','comment'));
    }

    public function comment_favorite(Request $request){
        $menu_flg = "1";
        $own = Auth::user();
        $favorite = mylist::where('user_id','=',$own['id'])->where('items_id','=',$request['id'])->first();
        if (empty($favorite)){
            $favorites = [
                'user_id' => $own['id'],
                'items_id' => $request['id'],
            ];
            mylist::create($favorites);
        }else {
            $favorite->delete();
        };
        $item = item::where('id','=',$request['id'])->first();
        $brand = brand::where('id','=',$item['brands_id'])->first();
        $category = category::where('id','=',$item['categories_id'])->first();
        $condition = condition::where('id','=',$item['conditions_id'])->first();
        $favorite = mylist::where('items_id','=',$request['id'])->count();
        $comment = comment::where('items_id','=',$request['id'])->count();
        $user = profile::join('comments','profiles.user_id','comments.user_id')->where('items_id','=',$request['id'])->get();
        $permission = permission::where('user_id','=',$own['id'])->first();
        return view('comment' , compact('menu_flg','own','item','brand','category','condition','favorite','comment','user','permission'));
    }
}

