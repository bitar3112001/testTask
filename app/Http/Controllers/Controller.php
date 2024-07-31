<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function logIn(Request $request){
        $incoming= $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        if(auth()->attempt(['email'=>$incoming['email'],'password'=>$incoming['password']])){
            $request->session()->regenerate();
             return redirect('/home');

        }else{
            return "sorry";
        }
    }

    public function register(Request $request){
        $incomingFields = $request->validate([
            'name'=>"required",
            'email'=>"required",
            'password'=>"required"
        ]);
        $incomingFields['password']=bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        return redirect('/');;
    }

}
