<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLeaveController extends Controller
{
    public function create() {

        return view ('employees.leaves.create');
    }

    public function store(Request $request) {

        $attributes = $request->validate([
            'subject' => 'required|min:3|max:255|string',
            'description' => 'required|string|min:1',
            'leave_date' => 'required|date|after:today',
            ]);

        $attributes += [
            'user_id' => Auth::id(), 
        ];

        $already_leave = Leave::ExistingLeaves($attributes['leave_date'])
            ->first();

        if ($already_leave) {

            return to_route('employees.index')
                ->with('success', 'Leave Already Applied for this Day !');     
        }

        Leave::create($attributes);  
        
        return to_route('employees.index')
            ->with('success', 'Leave Request Sent Successfully !');      
    }
}