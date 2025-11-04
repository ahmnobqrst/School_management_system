<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\{Teacher,Quiz,Student};

class Subject extends Model
{
    use HasFactory , HasTranslations , SoftDeletes;

    protected $guarded = [];
    public $translatable = ['name'];
    public $timestamps = true;

    public function grades()
    {
        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function classrooms()
    {
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    public function teachers()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
    public function Students(){
        return $this->belongsToMany(Student::class,'student_subject');
    }

    // public function quizzes()
    // {
    //     return $this->hasMany(Quiz::class);
    // }
}