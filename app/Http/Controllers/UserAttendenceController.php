<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Leave;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;

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
            else {

                $start = Carbon::parse($previous_attendence->date);
                $end =  Carbon::parse($now);
            
                $diff = $end->diffInDays($start);

                if ($diff > 1) {

                    $date = new DateTime($now);

                    for($i=1; $i<$diff; $i++) {

                        $absent_days = date_modify($date, '-'.$i.'day');

                        Attendence::create([
                            'user_id' => Auth::id(),
                            'date' => $absent_days,
                        ]);
                    }
                }
            }
        } 
         
        Attendence::create([
            'user_id' => Auth::id(),
            'date' => $now,
            'status' => Attendence::PRESENT
        ]);

        return back()->with('success', 'Your Today Attendence Done !');  
    }
}