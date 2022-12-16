<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
    
     */

     CONST ACTIVE = 1;

     CONST ADMIN = 1;

    protected $fillable = [
        'first_name',
        'last_name',
        'slug',
        'email',
        'role_id',
        'created_by',
        'password',
        'status',
        'email_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sluggable(): array {

        return [
            'slug' => [
                'source' => ['first_name', 'last_name']
        ]];
    }

    public function role() {
        
        return $this->belongsTo(Role::class);
    }

    public function getIsEmployeeAttribute() {

        return $this->role_id == Role::EMPLOYEE;
    }

    public function getFullNameAttribute() {

        return $this->first_name." ".$this->last_name;
    }

    public function scopeVisibleTo($query) {

        return $query->where('created_by', Auth::id());
    }
}
