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
        Schema::create('product_balance', function (Blueprint $table) {
            $table->id('credit_id');
            $table->bigInteger('credit_balance');
            $table->string('status');
            $table->string('date');
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('room_id')->on('rooms');
            $table->unsignedBigInteger('User_ID');
            $table->foreign('User_ID')->references('User_ID')->on('users');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_balance');
    }
};