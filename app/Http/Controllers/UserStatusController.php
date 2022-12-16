<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    public function userStatus(User $user) {

        if($user->status == true) {

            $attributes = [
                'status' => false
            ];

        } else {

            $attributes = [
                'status' => true
            ];
        }
        
        $user->update($attributes);
        
        return to_route('users.index');
    }
}
