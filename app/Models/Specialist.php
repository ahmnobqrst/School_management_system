<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Specialist extends Model
{
    use HasFactory , SoftDeletes , HasTranslations;

    protected $table = "specialists";
    public $translatable = ['name'];
    public $fillable = ['id', 'name','created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;
}