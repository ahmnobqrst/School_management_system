<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Models\Student;

class Payment extends Model
{
    use HasFactory , HasTranslations , SoftDeletes;

    public $guarded = [];
    public $translatable = ['description'];
    public $timestamps = true;

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }
}
