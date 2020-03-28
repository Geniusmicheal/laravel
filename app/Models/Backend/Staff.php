<?php

namespace App\Models\Backend;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model{

    protected $table = 'staff';

    protected $primaryKey =  'staff_id';


    // protected $hidden = [
    //     'password', 'remember_token',
    // ];


    /**
     * The name of the "updated at" column.
     *
     * @var string
     */

    const UPDATED_AT = null;
}