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
        Schema::create('class_schedules', function (Blueprint $table) {
            $table->id();
            $table->enum('day', ['sun', 'mon', 'tue', 'wed', 'thu']);
            $table->integer('period');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('teacher_id')->constrained();
            $table->unsignedInteger('section_id')->constrained();
            $table->unsignedInteger('subject_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_schedules');
    }
};
