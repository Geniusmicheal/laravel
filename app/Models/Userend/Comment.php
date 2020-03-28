<?php
namespace App\Models\Userend;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
    protected $table = 'comment';

    protected $primaryKey =  'comment_id';
    protected $fillable = [
        'user_id',
        'parent_id',
        'content_id',
        'type',
        'comment',
        'like'
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    public function user(){
        return $this->belongsTo('App\Models\Userend\User','user_id');
    }

    public function inner(){
        return $this->belongsTo('App\Models\Userend\Comment','parent_id');
    }
}