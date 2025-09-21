<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;


class Promotion extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded=[];

    public $timestamps = true;


    public function Students(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function From_Grade(){
        return $this->belongsTo(Grade::class,'from_grade');
    }

    public function From_Classroom(){
        return $this->belongsTo(Classroom::class,'from_classroom');
    }

    public function From_Section(){
        return $this->belongsTo(Section::class,'from_section');
    }

    public function To_Grade(){
        return $this->belongsTo(Grade::class,'to_grade');
    }

    public function To_Classroom(){
        return $this->belongsTo(Classroom::class,'to_classroom');
    }

    public function To_Section(){
        return $this->belongsTo(Section::class,'to_section');
    }
}