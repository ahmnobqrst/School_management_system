<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ProceesingFee extends Model
{
    use HasFactory , HasTranslations;

    protected $table = 'proceesingfee';  

    public $guarded = [];

    public $translatable = ['description'];

    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
}