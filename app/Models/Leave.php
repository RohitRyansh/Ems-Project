<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Leave extends Model
{
    use HasFactory;

    CONST APPROVE = 'approve';
    CONST REJECT = 'reject';
    CONST PENDING = 'pending';


    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'leave_date',
        'status'
    ];

    public function user() {
        
        return $this->belongsTo(User::class);
    }

    public function scopePendingLeaves($query) {

        return $query->where('status', self::PENDING);
    }

    public function scopeVisibleTo($query) {

        return $query->where('user_id', Auth::id());
    }

    public function scopeExistingLeaves($query, $leave) {
        return $query->where('user_id', Auth::id())
        ->where('leave_date', $leave)
        ->where('status', '!=', self::REJECT);
    }
}

