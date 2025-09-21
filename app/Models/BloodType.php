<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Spatie\Translatable\HasTranslations;

class BloodType extends Model
{
    use HasFactory ,  SoftDeletes;

    protected $table = 'blood_type';
    public $timestamps = true;

    

    protected $dates = ['deleted_at'];
    public $fillable = ['id', 'name','created_at', 'updated_at', 'deleted_at'];
}