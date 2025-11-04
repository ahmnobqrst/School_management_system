<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Grade,Section};
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model 
{

    
    use SoftDeletes;
    use HasTranslations;
    protected $table = 'Classrooms';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    public $translatable = ['name','desc'];
    public $fillable = ['id', 'name', 'desc', 'created_at', 'updated_at', 'deleted_at','Grade_id'];

    public function grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}