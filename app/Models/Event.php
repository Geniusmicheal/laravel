<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model{
    use SoftDeletes;
    protected $table = 'event';

    protected $primaryKey =  'event_id';

    protected $dates=['deleted_at'];
    protected $fillable = [
        'name',
        'event_date',
        'category_id',
        'location_id',
        'event_time',
        'youtube_url',
        'created_by',
        'created_id',
        'tickets',
        'event_type',
        'Sponsor_by',
        'about',
        'banner',
        'status',
        'address',
        'office',
        'num_phone',
        'website',
        'email',
        'slug'

    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}