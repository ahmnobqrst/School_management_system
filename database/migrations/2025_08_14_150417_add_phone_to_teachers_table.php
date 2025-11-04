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
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->unsignedInteger('national_teacher_id');
            $table->unsignedInteger('blood_type_teacher_id');
            // $table->foreignId('national_teacher_id')->constrained('nationals')->nullable()->onDelete('cascade');
            // $table->foreignId('blood_type_teacher_id')->constrained('blood_type')->nullable()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            //
        });
    }
};