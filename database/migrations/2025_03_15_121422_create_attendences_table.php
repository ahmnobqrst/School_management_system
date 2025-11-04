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
        Schema::create('attendences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('classroom_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('teacher_id');
            // $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            // $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
            // $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            // $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            $table->date('attendence_date');
            $table->enum('attendence_status',[1,0]);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendences');
    }
};
