<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Leave;
use App\Notifications\LeaveApprovalNotification;
use App\Notifications\LeaveRejectedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class LeaveManagementController extends Controller
{

    public function index() {

        return view ('users.requestUsers', [
            'leaves' => Leave::pendingLeaves()
                ->get()
        ]);
    }
    
    public function store(Leave $leave) {
        
        Attendence::create([
            'user_id' => $leave->user_id,
            'date' => $leave->leave_date,
            'status' => Attendence::LEAVE
        ]);

        $leave->update([
            'status' => Leave::APPROVE
        ]);

        $user = $leave->user()->first();

        Notification::send($user, new LeaveApprovalNotification(Auth::user()));

        return to_route('users.requests.index')
            ->with('success', 'Leave Approved Successfully.');   

    }

    public function delete(Leave $leave) {

        $leave->update([
            'status' => Leave::REJECT
        ]);

        $user = $leave->user()->first();

        Notification::send($user, new LeaveRejectedNotification(Auth::user()));

        return to_route('users.requests.index')
            ->with('unsuccess', 'Leave Rejected Successfully.');   

    }
}
