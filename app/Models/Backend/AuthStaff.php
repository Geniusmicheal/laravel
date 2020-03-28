<?php

namespace App\Models\Backend;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AuthStaff extends Authenticatable {
    
    use Notifiable;
    
    protected $table = 'staff';
    
    protected $primaryKey =  'staff_id';

    protected $fillable = [
        'name', 
        'email', 
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}