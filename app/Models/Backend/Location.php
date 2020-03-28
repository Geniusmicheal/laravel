<?php
namespace App\Models\Backend;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model{
    use SoftDeletes;
    protected $table = 'location';

    protected $primaryKey =  'location_id';

    protected $dates=['deleted_at'];

    protected $fillable = [
        'location', 'staff_id'
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}