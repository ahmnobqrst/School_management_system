<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\Translatable\HasTranslations;

class Attendence extends Model
{
    use HasFactory , SoftDeletes ;

    protected $table = 'attendences';

    public $guarded = [];
}
