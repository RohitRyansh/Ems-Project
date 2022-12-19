<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Attendence extends Model
{
    use HasFactory;

    CONST ABSENT = 'absent';
    CONST PRESENT = 'present';
    CONST LEAVE = 'leave';

    protected $fillable = [
        'user_id',
        'date',
        'status',
        'penalty'
    ];

    public function scopePreviousAttendence($query) {

        return $query->where('user_id', Auth::id())
            ->where('status', self::PRESENT)
            ->latest();
    }

    public function scopePreviousLeave($query) {

        return $query->where('user_id', Auth::id())
            ->where('status', self::LEAVE)
            ->latest();
    }

    public function scopeAttendenceMarked($query, $user_id, $date, $status) {

        return $query->create([
            'user_id' => $user_id,
            'date' => $date,
            'status' => $status
        ]);
    }
}
