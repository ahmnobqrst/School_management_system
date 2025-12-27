<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Models\Quiz;

class Question extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['title', 'answer', 'right_answer'];

    protected $guarded = [];

    public $timestamps = true;


    public function quizz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function responses()
    {
        return $this->hasMany(StudentResponse::class, 'question_id');
    }
}
