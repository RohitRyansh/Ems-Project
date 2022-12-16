<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    CONST ADMIN = 1;
    CONST EMPLOYEE=2;


    public function scopeAllRoles($query) {

        return $query->where('id', '!=', self::ADMIN);
    }
}
