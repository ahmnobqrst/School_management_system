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
            $table->unsignedInteger('grade_id');
            $table->unsignedInteger('classroom_id');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('section_id');
            // $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            // $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            // $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            // $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
            // $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
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
