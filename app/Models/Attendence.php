<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Student;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Section;
// use Spatie\Translatable\HasTranslations;

class Attendence extends Model
{
    use HasFactory , SoftDeletes ;

    protected $table = 'attendences';

    public $guarded = [];

    public function students()
    {
         return $this->belongsTo(Student::class, 'student_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
