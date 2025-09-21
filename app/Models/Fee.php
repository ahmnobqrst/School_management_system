<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasFactory , SoftDeletes , HasTranslations;

    public $guarded = [];
    public $translatable = ['name','desc'];
    public $timestamps = true;


    public function Classes()
    {
        return $this->belongsTo(Classroom::class , 'classroom_id');
    }

    public function Grades(){
        return $this->belongsTo(Grade::class,'grade_id');
    }
}