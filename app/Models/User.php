<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable, SoftDeletes;

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

    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function scopeSearch($query, array $filter) {

        $query->when($filter['search'] ?? false, function($query, $search) {

            return $query->where('first_name', 'like', '%'. $search . '%')
                ->orwhere('email', 'like', '%'. $search . '%');
        });

        $query->when($filter['newest']?? false, function($query) {

            return $query->orderby('created_at', 'desc');
        });
    }

}