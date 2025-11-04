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
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique;
            $table->string('password');
            $table->date('birth_of_date');
            $table->string('academic_year');
            $table->integer('national_student_id')->unsigned();
            // $table->foreign('national_student_id')->references('id')->on('nationals')->onDelete('cascade');
            $table->integer('blood_type_student_id')->unsigned();
            // $table->foreign('blood_type_student_id')->references('id')->on('blood_type')->onDelete('cascade');
            $table->integer('gender_id')->unsigned();
            // $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->integer('grade_id')->unsigned();
            // $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->integer('parent_id')->unsigned();
            // $table->foreign('parent_id')->references('id')->on('my_parents')->onDelete('cascade');
            $table->integer('classroom_id')->unsigned();
            // $table->foreign('classroom_id')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->integer('section_id')->unsigned();
            // $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
