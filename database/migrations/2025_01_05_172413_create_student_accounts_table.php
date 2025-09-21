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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('type');
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedInteger('receipt_id')->nullable();
            $table->foreign('receipt_id')->references('id')->on('reciepts')->onDelete('cascade');
            $table->unsignedInteger('fee_invoice_id')->nullable();
            $table->foreign('fee_invoice_id')->references('id')->on('fee_inovices')->onDelete('cascade');
            $table->foreignId('process_id')->nullable()->constraints('proceesingfee')->onDelete('cascade');
            $table->foreignId('payment_id')->nullable()->constraints('payments')->onDelete('cascade');
            $table->decimal('debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->string('desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
