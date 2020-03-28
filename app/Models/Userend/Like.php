<?php
namespace App\Models\Userend;
use Illuminate\Database\Eloquent\Model;

class Like extends Model{
    protected $table = 'voted';

    protected $primaryKey =  'id';
    protected $fillable = [
        'user_id',
        'content_id',
        'type',
        'vote'
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

}