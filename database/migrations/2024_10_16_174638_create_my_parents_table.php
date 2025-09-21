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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
           // data of father
            $table->string('name_of_father');
            $table->string('father_phone');
            $table->string('father_job');
            $table->string('father_ID');
            $table->string('father_address');
            $table->integer('national_father_id')->unsigned();
            $table->integer('blood_type_father_id')->unsigned();
            $table->integer('religion_father_id')->unsigned();
          // data of mother
            $table->string('name_of_mother');
            $table->string('mother_phone');
            $table->string('mother_job');
            $table->string('mother_ID');
            $table->string('mother_address');
            $table->integer('national_mother_id')->unsigned();
            $table->integer('blood_type_mother_id')->unsigned();


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_parents');
    }
};
