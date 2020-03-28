<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model{
    use SoftDeletes;
    protected $table = 'news';

    protected $primaryKey =  'news_id';

    protected $dates=['deleted_at'];
    protected $fillable = [
        'staff_id',
        'headline',
        'category_id',
        'location_id',
        'source_url',
        'source',
        'youtube_url',
        'short_content',
        'content',
        'newsImage',
        'slug',
        'download_url',
        'post_id',
        'home'
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;



    // public function record(){
    //     return $this->hasManyThrough('App\Models\Backend\Location','location_id','category_id');
    // }

    public function categorys(){
        return $this->belongsTo('App\Models\Backend\Category','category_id');
    }

    public function locations(){
        return $this->belongsTo('App\Models\Backend\Location','location_id');
    }
}