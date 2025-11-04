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
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('grade_id');
            $table->unsignedInteger('classroom_id');
            $table->unsignedInteger('teacher_id');
            // $table->foreignId('grade_id')->constrained('grades')->onCascadeDelete();
            // $table->foreignId('classroom_id')->constrained('classrooms')->onCascadeDelete();
            // $table->foreignId('teacher_id')->constrained('teachers')->onCascadeDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
