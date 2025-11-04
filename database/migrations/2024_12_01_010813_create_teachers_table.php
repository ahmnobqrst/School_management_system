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
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('name');
            $table->integer('specialist_id')->unsigned();
            // $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('cascade');
            $table->integer('gender_id')->unsigned();
            // $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->string('address');
            $table->string('age');
            $table->date('date_of_job');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
