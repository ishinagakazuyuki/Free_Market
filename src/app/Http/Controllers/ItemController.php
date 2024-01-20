<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\category;
use App\Models\condition;
use App\Models\item;

use App\Http\Requests\SaleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request){
        $menu_flg = "1";
        return view('index' , compact('menu_flg'));
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
        $path = $file->storeAs('images', $filename, 'public');
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
}

