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
            $table->foreignId('student_id')->constraints('students')->onDelete('cascade');
            $table->foreignId('classroom_id')->constraints('classrooms')->onDelete('cascade');
            $table->foreignId('section_id')->constraints('sections')->onDelete('cascade');
            $table->foreignId('teacher_id')->constraints('teachers')->onDelete('cascade');
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
