<?php

namespace App\Models;

use App\Events\BaseModelDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    public $incrementing = true;

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $dispatchesEvents = [
        'deleted' => BaseModelDeleted::class,
    ];

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
