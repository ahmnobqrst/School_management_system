<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Models\Student;

class MyParent extends Model
{
    use HasFactory , HasTranslations , SoftDeletes;

    protected $table = 'my_parents';
    public $translatable = ['name_of_father','father_job','name_of_mother','mother_job','father_address','mother_address'];
    protected $fillable = ['id', 'email', 'password', 'name_of_father', 'father_phone', 
    'father_job', 'father_ID', 'father_address', 'national_father_id', 'blood_type_father_id', 'religion_father_id', 'name_of_mother', 'mother_phone', 'mother_job', 'mother_ID', 'mother_address',
     'national_mother_id', 'blood_type_mother_id', 'created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}