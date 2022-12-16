<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {

        return view ('users.login');
    }

    public function userAuthentication(Request $request) {
        
        $attributes=$request->validate ([   
            'email' =>  'required|email',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', $attributes['email'])->first();

        if ($user) {
            
            if ($user->status==User::ACTIVE && Auth::attempt($attributes)) {
                
                return redirect('/');
            }  
            else {
        
                return back()->with('error', 'Status Inactive');
            } 
        }

        return back()->with('error', 'Wrong Credentials');
    }
    
    public function logout() {

        Auth::logout();

        return redirect('/');
    }  
}
