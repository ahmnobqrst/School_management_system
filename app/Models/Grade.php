<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Models\{Section,Teacher};


class Grade extends Model 
{

    use SoftDeletes;
    use HasTranslations;

    protected $table = "Grades";
    public $translatable = ['name','desc'];
    public $fillable = ['id', 'name', 'desc', 'created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;


public function Sections(){
    return $this->hasMany(Section::class,'Grade_id');
}
    
public function teachers()
{
    return $this->hasMany(Teacher::class, 'grade_id');
}

    

}