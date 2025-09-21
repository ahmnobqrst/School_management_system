<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('Classrooms', function(Blueprint $table) {
			$table->foreign('Grade_id')->references('id')->on('Grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('Grade_id')->references('id')->on('Grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('my_parents', function(Blueprint $table) {
			$table->foreign('national_father_id')->references('id')->on('nationals')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('blood_type_father_id')->references('id')->on('blood_type')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('religion_father_id')->references('id')->on('religions')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('national_mother_id')->references('id')->on('nationals')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('blood_type_mother_id')->references('id')->on('blood_type')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('parent_attachments', function(Blueprint $table) {
			$table->foreign('parent_id')->references('id')->on('my_parents')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('sections', function(Blueprint $table) {
			$table->foreign('Class_id')->references('id')->on('Classrooms')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('Classrooms', function(Blueprint $table) {
			$table->dropForeign('Classrooms_Grade_id_foreign');
		});
	}
}