<?php
namespace App\Models\Backend;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model{
    use SoftDeletes;
    protected $table = 'category';

    protected $primaryKey =  'category_id';

    protected $dates=['deleted_at'];

    protected $fillable = [
        'category', 'staff_id', 'action',
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}