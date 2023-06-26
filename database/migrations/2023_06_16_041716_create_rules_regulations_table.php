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
        Schema::create('rules_regulations', function (Blueprint $table) {
            $table->id('rules_id');
            $table->string('rules');
            $table->unsignedBigInteger('User_ID');
            $table->foreign('User_ID')->references('User_ID')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules_regulations');
    }
};