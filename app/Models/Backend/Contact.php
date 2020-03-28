<?php
namespace App\Models\Backend;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Contact extends Model{
    use SoftDeletes;
    protected $table = 'contact';

    protected $primaryKey =  'contact_id';

    protected $dates=['deleted_at'];

    protected $fillable = [
        'name', 'email', 'message',
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}