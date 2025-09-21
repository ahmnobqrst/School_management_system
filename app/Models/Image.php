<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory , SoftDeletes;


    public $fillable = ['filename','imageable_id','imageable_type','created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;

    public function imageable()
    {
        return $this->morphTo();
    }
}
