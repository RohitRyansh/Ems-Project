<?php

namespace App\Models;

use Attribute;
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
        'status'
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

    public function scopeAttendenceMarked($query, $user, $date, $status) {

        return $query->create([
            'user_id' => $user,
            'date' => $date,
            'status' => $status
        ]);
    }
}