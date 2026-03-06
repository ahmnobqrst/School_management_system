<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Models\Student;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MyParent extends Authenticatable
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $table = 'my_parents';
    public $translatable = ['name_of_father', 'father_job', 'name_of_mother', 'mother_job', 'father_address', 'mother_address'];
    protected $guarded = [];
    public $timestamps = true;




    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
