<?php

namespace App\Models\Backend;
use Illuminate\Database\Eloquent\Model;

class Log extends Model{

    protected $table = 'staff_log';

    protected $primaryKey =  'log_id';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}