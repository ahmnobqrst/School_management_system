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
        Schema::create('liberaries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_name');
             $table->unsignedInteger('classroom_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('grade_id');
            $table->unsignedInteger('teacher_id');
            // $table->foreignId('grade_id')->constrained('grades')->onDeleteCascade();
            // $table->foreignId('classroom_id')->constrained('classrooms')->onDeleteCascade();
            // $table->foreignId('section_id')->constrained('sections')->onDeleteCascade();
            // $table->foreignId('teacher_id')->constrained('teachers')->onDeleteCascade();
            $table->timestamps();
            $table->softDeletes();
        });


        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liberaries');
    }
};
