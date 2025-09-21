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
        Schema::create('proceesingfee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->decimal('amount')->nullable();
            $table->date('date');
            $table->foreignId('student_id')->contaraints('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proceesingfee');
    }
};
