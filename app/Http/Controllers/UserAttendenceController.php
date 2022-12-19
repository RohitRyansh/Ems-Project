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

            if($previous_attendence->date == $now) {
                
                return back()->with('unsuccess', 'Your Today Attendence Already Done !');
            }
            // user absent functionality
            else {
            
                $diff = Carbon::parse($now)
                    ->diffInDays(Carbon::parse($previous_attendence->date));

                if ($diff > 1) {

                    for($i=1; $i<$diff; $i++) {

                        $date = new DateTime($now);

                        $absent_days = date_modify($date, '-'.$i.'day');

                        $previous_leave = Attendence::PreviousLeave()->first();

                        if($previous_leave) {

                            if (new DateTime($previous_leave->date) == $absent_days){
                                continue;
                            }
                        }

                        Attendence::create([
                            'user_id' => Auth::id(),
                            'date' =>  $absent_days,
                            'status' => Attendence::ABSENT,
                            'penalty' => 10
                        ]);
                    }
                }
            }
        }

        $time = now()->toTimeString();

        if ($time >= '09:30:00' && $time <= '20:00:00') {

            Attendence::AttendenceMarked(Auth::id(), $now, Attendence::PRESENT);

            return back()->with('success', 'Your Today Attendence Done !');  
        }

        return back()->with('unsuccess', 'Attendence Time has been Expired Today !');  
    }
}