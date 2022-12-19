<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function index() {
      
        return view ('users.index', [
            'users' => User::visibleTo(Auth::id())
                ->search (
                    request ([
                        'search',
                        'newest'
                        ]))
                ->get(),
        ]);
    }

    public function create() {
        
        return view ('users.create');
    }

    public function store(Request $request) {

        $attributes = $request->validate ([   
            'first_name' =>  'required|string|min:3|max:255',
            'last_name' => 'required|string|min:1|max:255',
            'email' => 'required|email'  
        ]);

        $attributes += [
            'role_id' => Role::EMPLOYEE,
            'created_by' => Auth::id()
        ];

        $user = User::where('email', $attributes['email'])
            ->withTrashed()
            ->first();

        if ($user) {
        
            if ($user->deleted_at != null) {

                $user->restore();
                $user->update($attributes);
            }

        } else {

            $user = User::create($attributes);
        }

        Notification::send($user, new SetPasswordNotification(Auth::user()));

        if ($request['create'] == 'create') {  

            return to_route('users.edit', $user)
                ->with('success',  'User Created Successfully.');
        }

        return back()->with('success', 'User Created Successfully.');   
    }

    public function edit(User $user) {
        
        return view ('users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user) {

        $attributes = $request->validate ([   
            'first_name' =>  'required|string|min:3|max:255',
            'last_name' => 'required|string|min:1|max:255',
        ]);

        $user->update($attributes);

        return to_route('users.index')
            ->with('success', 'User Updated Successfully.');  
    }

    public function delete(User $user) {
        
        $user->delete();

        return to_route('users.index')
            ->with('success', 'User Deleted Successfully.');   
    }
}