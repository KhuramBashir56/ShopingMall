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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 48);
            $table->string('email', 60)->unique();
            $table->string('password');
            $table->string('pin')->nullable();
            $table->string('profile_image', 255)->nullable()->unique();
            $table->enum('role', ['admin', 'manager', 'keeper', 'deliveryman', 'user'])->default('user');
            $table->bigInteger('rolled_by')->default(0);
            $table->enum('status', ['active', 'blocked', 'deleted'])->default('active');
            $table->ipAddress('ip');
            $table->string('device');
            $table->enum('terms', [0, 1]);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};