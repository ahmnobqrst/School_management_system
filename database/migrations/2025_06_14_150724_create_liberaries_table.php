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
            $table->foreignId('grade_id')->constraints('grades')->onDeleteCascade();
            $table->foreignId('classroom_id')->constraints('classrooms')->onDeleteCascade();
            $table->foreignId('section_id')->constraints('sections')->onDeleteCascade();
            $table->foreignId('teacher_id')->constraints('teachers')->onDeleteCascade();
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
