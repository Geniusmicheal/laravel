<?php
namespace App\Models\Userend;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model{
    use SoftDeletes;
    protected $table = 'user';
    
    protected $primaryKey =  'user_id';
    protected $dates=['deleted_at'];

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