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

        return $query->where('user_id', Auth::id())->latest();
    }
}