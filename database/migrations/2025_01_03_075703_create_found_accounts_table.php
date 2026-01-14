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
        Schema::create('found_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->unsignedInteger('receipt_id')->nullable();
            // $table->foreign('receipt_id')->references('id')->on('reciepts')->onDelete('cascade');
            // $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('cascade');
            $table->unsignedInteger('payment_id')->nullable();
            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_accounts');
    }
};
