<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\profile;

use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function manage(Request $request){
        $menu_flg = "1";
        $users = user::join('profiles','users.id','profiles.user_id')->paginate(5);
        return view('manage' , compact('menu_flg','users'));
    }
    public function delete(Request $request){
        $menu_flg = "1";
        user::where('id','=',$request['id'])->delete();
        $users = user::join('profiles','users.id','profiles.user_id')->paginate(5);
        return view('manage' , compact('menu_flg','users'));
    }
}
