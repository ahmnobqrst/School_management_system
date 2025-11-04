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
        Schema::create('online__classes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('classroom_id');
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('grade_id');
            // $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade');
            // $table->foreignId('classroom_id')->constrained('classrooms')->onDelete('cascade');
            // $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('created_by');
            $table->string('meeting_id');
            $table->string('topic');  // عنوان الحصة
            $table->dateTime('start_at');
            $table->integer('duration')->comment('minutes');
            $table->string('password')->comment('meeting password'); // ممكن يكون الاجتماع ليه باسورد
            $table->text('start_url'); // url بالنسبة لصاحب الحصة
            $table->text('join_url'); // url ده اللينك ال الطلاب هيخشو عليه
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online__classes');
    }
};
