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
        Schema::create('fee_inovices', function (Blueprint $table) {
            $table->increments('id');
            $table->date('invoice_date');
            $table->unsignedInteger('student_id');
            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedInteger('grade_id');
            // $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->unsignedInteger('classroom_id');
            // $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->unsignedInteger('fee_id');
            // $table->foreign('fee_id')->references('id')->on('fees')->onDelete('cascade');
            $table->decimal('amount',8,2);
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_inovices');
    }
};
