<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Specialist;
use App\Models\{Classroom, Gender,Grade,Subject};
use App\Models\Section;
use App\Models\BloodType;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
{
    use HasFactory , SoftDeletes , HasTranslations;

    protected $table = "teachers";
    public $translatable = ['name','address'];
    public $guarded = [];
    public $timestamps = true;


    public function Specializations(){
        return $this->belongsTo(Specialist::class , 'specialist_id'); 
    }

    public function Genders(){
        return $this->belongsTo(Gender::class , 'gender_id'); 
    }

    public function Sections(){
        return $this->belongsToMany(Section::class,'teacher_section');
    }

    public function Nationality(){
        return $this->belongsTo(National::class,'national_teacher_id');
    }
    public function BloodType(){
        return $this->belongsTo(BloodType::class,'blood_type_teacher_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class,'grade_id');
    }
    public function Classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
    
}