<?php

namespace App\Models\Userend;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AuthUser extends Authenticatable {
    
    use Notifiable;
    
    protected $table = 'user';
    
    protected $primaryKey =  'user_id';

    protected $fillable = [
        'username', 
        'email', 
        'password',
        'img',
        'occupation',
        'phone_number',
        'social_media',
        'current_location',
        'dob',
        'about'
    ];

    protected $hidden = [
        'password',
    ];
    const UPDATED_AT = null;
}