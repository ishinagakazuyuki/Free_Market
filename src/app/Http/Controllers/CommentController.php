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

use App\Http\Requests\CommentRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function comment(Request $request){
        $menu_flg = "1";
        $own = Auth::user();
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
        $condition = condition::where('id','=',$item['conditions_id'])->first();
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
        $condition = condition::where('id','=',$item['conditions_id'])->first();
        $favorite = mylist::where('items_id','=',$request['id'])->count();
        $comment = comment::where('items_id','=',$request['id'])->count();
        $user = profile::join('comments','profiles.user_id','comments.user_id')->where('items_id','=',$request['id'])->get();
        $permission = permission::where('user_id','=',$own['id'])->first();
        return view('comment' , compact('menu_flg','own','item','brand','category','condition','favorite','comment','user','permission'));
    }
}

