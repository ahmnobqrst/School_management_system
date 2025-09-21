<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->foreignId('subject_id')->constraints('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->constraints('teachers')->onDelete('cascade');
            $table->foreignId('grade_id')->constraints('grades')->onDelete('cascade');
            $table->foreignId('classroom_id')->constraints('classrooms')->onDelete('cascade');
            $table->foreignId('section_id')->constraints('sections')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
