<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\StudentAccount;
use App\Models\Gender;
use App\Models\MyParent;
use App\Models\National;
use App\Models\Section;
use App\Models\Image;
use App\Models\Specialist;
use App\Models\Religions;
use App\Models\BloodType;
use App\Models\Attendence;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory , SoftDeletes , HasTranslations;

    protected $table = 'students';
    public $guarded = [];
    public $translatable = ['name'];
    public $timestamps = true;

    public function Parents(){
        return $this->belongsTo(MyParent::class,'parent_id');
    }

    public function Section(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function Subjects(){
        return $this->belongsToMany(Subject::class,'student_subject');
    }

    public function Grade(){
        return $this->belongsTo(Grade::class,'grade_id');
    }

    public function Gender(){
        return $this->belongsTo(Gender::class,'gender_id');
    }

    public function Classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function Nationality(){
        return $this->belongsTo(National::class,'national_student_id');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccount::class, 'student_id');

    }

    public function attendance()
    {
        return $this->hasMany(Attendence::class, 'student_id');
    }

    public function BloodType(){
        return $this->belongsTo(BloodType::class,'blood_type_student_id');
    }

    
}