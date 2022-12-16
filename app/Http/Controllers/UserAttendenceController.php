<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

//Wip line number (37 - 49)
class UserAttendenceController extends Controller
{
    public function index() {

        return view ('employees.index',[
            'leaves' => Leave::visibleTo()
                ->get()
        ]);

    }

    public function store() {

        $now = now()->toDateString();

        $previous_attendence = Attendence::previousAttendence()
            ->first();

        if($previous_attendence) {

            if($previous_attendence->created_at->toDateString() == $now) {
                
                return back()->with('unsuccess', 'Your Today Attendence Already Done !');
            }
            // Employe Absent is not complete
            // else {

            //     $start = Carbon::parse($previous_attendence->date);
            //     $end =  Carbon::parse($now);
            
            //     $days = $end->diffInDays($start);

            //     if ($days > 1) {
            //         // dd('hi');    
            //     }
            // }
        } 
        Attendence::create([
            'user_id' => Auth::id(),
            'date' => $now,
            'status' => Attendence::PRESENT
        ]);

        return back()->with('success', 'Your Today Attendence Done !');
        
    }
}
