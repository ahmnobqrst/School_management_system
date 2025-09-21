<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Subject;

class Quiz extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $guarded = [];
    public $translatable = ['name'];

    public $timestamps = true;

    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }


}