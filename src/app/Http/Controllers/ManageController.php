<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\profile;

use App\Http\Requests\ManageRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    public function send(ManageRequest $request){
        $menu_flg = "1";
        $to = $request['address'];
        $subject = $request['title'];
        $message = $request['text'];
        if(!empty($to)){
            $user_id = user::where('email','=',$to)->first();
            $name = profile::where('user_id','=',$user_id['id'])->first();
            $name = $name['name'];
            if(empty($name)){
                $name = $to;
            }
            Mail::send([], [], function($mail) use ($name, $to, $subject, $message) {
                $mail->to($to)
                    ->subject($subject)
                    ->setBody("{$name}様\n\n{$message}");
            });
        }else {
            $emails = user::get();
            foreach ($emails as $email){
                $to = $email['email'];
                $user_id = user::where('email','=',$to)->first();
                $name = profile::where('user_id','=',$user_id['id'])->first();
                $name = $name['name'];
                if(empty($name)){
                    $name = $to;
                }
                Mail::send([], [], function($mail) use ($name, $to, $subject, $message) {
                    $mail->to($to)
                        ->subject($subject)
                        ->setBody("{$name} 様\n\n{$message}");
                });
            }
        }
        $users = user::join('profiles','users.id','profiles.user_id')->paginate(5);
        return view('manage' , compact('menu_flg','users'));
    }
}
