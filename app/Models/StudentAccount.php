<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class StudentAccount extends Model
{
    

    use HasFactory , SoftDeletes , HasTranslations;

    public $guarded = [];
    public $translatable = ['desc'];
    public $timestamps = true;


    

    
   
}