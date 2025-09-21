<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Models\Classroom;
use App\Models\Teacher;

class Section extends Model
{
    use HasFactory , SoftDeletes, HasTranslations;

    protected $table = "sections";
    public $translatable = ['section_name', 'status'];
    public $fillable = ['id', 'section_name', 'status', 'Grade_id', 'Class_id', 'created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;

    public function Classes()
    {
        return $this->belongsTo(Classroom::class , 'Class_id');
    }

    public function Teachers(){
        return $this->belongsToMany(Teacher::class,'teacher_section');
    }


    


    
}