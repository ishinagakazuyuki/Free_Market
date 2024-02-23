<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\category;
use App\Models\condition;
use App\Models\item;
use App\Models\mylist;
use App\Models\comment;
use App\Models\profile;
use App\Models\permission;

use App\Http\Requests\SaleRequest;
use App\Http\Requests\CommentRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request){
        $menu_flg = "1";
        $user = Auth::user();
        $item = item::orderBy('id', 'desc')->get();
        if (empty($user['id'])){
            $mylist = null;
        }else {
            $mylist = mylist::join('items','mylists.items_id','items.id')->where('mylists.user_id','=',$user['id'])->orderBy('mylists.id', 'desc')->get();
            $profile = profile::where('user_id','=',$user['id'])->first();
            if (empty($profile)){
                profile::create([
                    'user_id' => $user['id'],
                ]);
            }
        }
        return view('index' , compact('menu_flg','item','mylist'));
    }
    public function sell(Request $request){
        $menu_flg = "1";
        $brand = brand::get();
        $category = category::get();
        $condition = condition::get();
        return view('sell' , compact('menu_flg','brand','category','condition'));
    }
    public function sale(SaleRequest $request){
        if (empty($request['new_brand'])){
            $brands_id = $request['brand'];
        }else{
            $new_brands = [
                'name' => $request['new_brand'],
            ];
            brand::create($new_brands);
            $brand = brand::where('name','=',$request['new_brand'],)->first();
            $brands_id = $brand['id'];
        };
        if (empty($request['new_first'])){
            $categories_id = $request['category'];
        }else{
            $new_categories = [
                'first' => $request['new_first'],
                'second' => $request['new_second'],
            ];
            category::create($new_categories);
            $category = category::where('first','=',$request['new_first'],)->first();
            $categories_id = $category['id'];
        };
        if (empty($request['new_condition'])){
            $conditions_id = $request['condition'];
        }else{
            $new_conditions = [
                'name' => $request['new_condition'],
            ];
            condition::create($new_conditions);
            $condition = condition::where('name','=',$request['new_condition'],)->first();
            $conditions_id = $condition['id'];
        };
        $user = Auth::user();
        $currentDate = date('YmdHis');
        $file = $request->file('image');
        $filename = $user['id'] . "_" . $currentDate . "." . $file->getClientOriginalExtension();
        $path = Storage::disk('local')->putFileAs('public/images', $file, $filename);
        $items = [
            'user_id' => $user['id'],
            'name' => $request['name'],
            'brands_id' => $brands_id,
            'description' => $request['description'],
            'categories_id' => $categories_id,
            'conditions_id' => $conditions_id,
            'value' => $request['value'],
            'image' => $filename,
        ];
        item::create($items);
        $menu_flg = "1";
        $brand = brand::get();
        $category = category::get();
        $condition = condition::get();
        return view('sell' , compact('menu_flg','brand','category','condition'));
    }
    public function detail(Request $request){
        $menu_flg = "1";
        $item = item::where('id','=',$request['id'])->first();
        $brand = brand::where('id','=',$item['brands_id'])->first();
        $category = category::where('id','=',$item['categories_id'])->first();
        $condition = condition::where('id','=',$item['categories_id'])->first();
        $favorite = mylist::where('items_id','=',$request['id'])->count();
        $comment = comment::where('items_id','=',$request['id'])->count();
        return view('detail' , compact('menu_flg','item','brand','category','condition','favorite','comment'));
    }
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
        $condition = condition::where('id','=',$item['categories_id'])->first();
        $favorite = mylist::where('items_id','=',$request['id'])->count();
        $comment = comment::where('items_id','=',$request['id'])->count();
        return view('detail' , compact('menu_flg','item','brand','category','condition','favorite','comment'));
    }
    public function comment(Request $request){
        $menu_flg = "1";
        $own = Auth::user();
        $item = item::where('id','=',$request['id'])->first();
        $brand = brand::where('id','=',$item['brands_id'])->first();
        $category = category::where('id','=',$item['categories_id'])->first();
        $condition = condition::where('id','=',$item['categories_id'])->first();
        $favorite = mylist::where('items_id','=',$request['id'])->count();
        $comment = comment::where('items_id','=',$request['id'])->count();
        $user = profile::join('comments','profiles.user_id','comments.user_id')->where('items_id','=',$request['id'])->get();
        $permission = permission::where('user_id','=',$own['id'])->first();
        return view('comment' , compact('menu_flg','own','item','brand','category','condition','favorite','comment','user','permission'));
    }
    public function post(CommentRequest $request){
        $menu_flg = "1";
        $own = Auth::user();
        $post = [
            'user_id' => $own['id'],
            'items_id' => $request['id'],
            'comment' => $request['comment'],
        ];
        comment::create($post);
        $item = item::where('id','=',$request['id'])->first();
        $brand = brand::where('id','=',$item['brands_id'])->first();
        $category = category::where('id','=',$item['categories_id'])->first();
        $condition = condition::where('id','=',$item['categories_id'])->first();
        $favorite = mylist::where('items_id','=',$request['id'])->count();
        $comment = comment::where('items_id','=',$request['id'])->count();
        $user = profile::join('comments','profiles.user_id','comments.user_id')->where('items_id','=',$request['id'])->get();
        $permission = permission::where('user_id','=',$own['id'])->first();
        return view('comment' , compact('menu_flg','own','item','brand','category','condition','favorite','comment','user','permission'));
    }
    public function comment_favorite(Request $request){
        $menu_flg = "1";
        $own = Auth::user();
        $favorite = mylist::where('user_id','=',$user['id'])->where('items_id','=',$request['id'])->first();
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
        $condition = condition::where('id','=',$item['categories_id'])->first();
        $favorite = mylist::where('items_id','=',$request['id'])->count();
        $comment = comment::where('items_id','=',$request['id'])->count();
        $user = profile::join('comments','profiles.user_id','comments.user_id')->where('items_id','=',$request['id'])->get();
        $permission = permission::where('user_id','=',$own['id'])->first();
        return view('comment' , compact('menu_flg','own','item','brand','category','condition','favorite','comment','user','permission'));
    }
    public function comment_delete(Request $request){
        $menu_flg = "1";
        $own = Auth::user();
        $delete = comment::where('id','=',$request['comment_id'])->first();
        $delete->delete();
        $item = item::where('id','=',$request['id'])->first();
        $brand = brand::where('id','=',$item['brands_id'])->first();
        $category = category::where('id','=',$item['categories_id'])->first();
        $condition = condition::where('id','=',$item['categories_id'])->first();
        $favorite = mylist::where('items_id','=',$request['id'])->count();
        $comment = comment::where('items_id','=',$request['id'])->count();
        $user = profile::join('comments','profiles.user_id','comments.user_id')->where('items_id','=',$request['id'])->get();
        $permission = permission::where('user_id','=',$own['id'])->first();
        return view('comment' , compact('menu_flg','own','item','brand','category','condition','favorite','comment','user','permission'));
    }
}

