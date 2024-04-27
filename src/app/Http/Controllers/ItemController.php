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

use App\Http\Requests\SaleRequest;

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

    public function search(Request $request){
        $menu_flg = "1";
        $search = $request['search'];
        $item = item::join('brands','items.brands_id','brands.id')->join('categories','items.categories_id','categories.id')
            ->where(function($query) use ($search) {
                $query->Where('items.name', 'like', '%'.$search.'%')->orWhere('brands.brand_name', 'like', '%'.$search.'%')
                ->orWhere('categories.first', 'like', '%'.$search.'%')->orWhere('categories.second', 'like', '%'.$search.'%');
        })->orderBy('items.id', 'desc')->select('items.*', 'brands.brand_name', 'categories.first', 'categories.second')->get();
        $count = $item->count();
        if (empty($search)) {
            $message = "全件検索を行いました";
        } else {
            if ($count == 0){
                $message = $search."の検索結果はありません";
                $item = null;
            } else {
                $message = $search."を検索した結果、".$count."件がヒットしました";
            }
        }
        return view('search' , compact('menu_flg','item','message'));
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
        $env = env('APP_ENV');
        if($env == 'local') {
            $path = Storage::disk('local')->putFileAs('public/images', $file, $filename);
            $url = asset('storage/images/'.$filename);
        } else {
            $path = Storage::disk('s3')->putFileAs('public/images', $file, $filename);
            $url = Storage::disk('s3')->url($path);
        }
        $items = [
            'user_id' => $user['id'],
            'name' => $request['name'],
            'brands_id' => $brands_id,
            'description' => $request['description'],
            'categories_id' => $categories_id,
            'conditions_id' => $conditions_id,
            'value' => $request['value'],
            'image' => $url,
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
        $condition = condition::where('id','=',$item['conditions_id'])->first();
        $favorite = mylist::where('items_id','=',$request['id'])->count();
        $comment = comment::where('items_id','=',$request['id'])->count();
        return view('detail' , compact('menu_flg','item','brand','category','condition','favorite','comment'));
    }
}

