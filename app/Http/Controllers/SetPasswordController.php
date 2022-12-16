<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SetPasswordController extends Controller
{
    public function index(User $user) {

        return view('users.setPassword', [
            'user'=>$user
        ]);
    }

    public function store(Request $request, User $user) {

        $attributes = $request->validate ([
            'password'=>'required|min:8',
            'ConfirmPassword'=>'required|min:8|same:password'
        ]);

        if ($user->update ([
            
            'password'=>Hash::make($attributes['password']),
            'email_status'=>1
        ])) {

            $login=new LoginController;
            $url=$login->userAuthentication($request);
            
            return redirect($url->getTargetUrl());
        }
    }
}