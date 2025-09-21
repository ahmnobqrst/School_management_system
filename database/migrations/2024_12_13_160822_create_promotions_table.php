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
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->integer('from_grade')->unsigned();
            $table->foreign('from_grade')->references('id')->on('grades')->onDelete('cascade');
            $table->integer('from_classroom')->unsigned();
            $table->foreign('from_classroom')->references('id')->on('classrooms')->onDelete('cascade');
            $table->integer('from_section')->unsigned();
            $table->foreign('from_section')->references('id')->on('sections')->onDelete('cascade');

            $table->integer('to_grade')->unsigned();
            $table->foreign('to_grade')->references('id')->on('grades')->onDelete('cascade');
            $table->integer('to_classroom')->unsigned();
            $table->foreign('to_classroom')->references('id')->on('classrooms')->onDelete('cascade');
            $table->integer('to_section')->unsigned();
            $table->foreign('to_section')->references('id')->on('sections')->onDelete('cascade');
            

            $table->string('academic_year');
            $table->string('academic_year_new');

            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
