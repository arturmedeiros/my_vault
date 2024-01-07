<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_users', function (Blueprint $table) {
            $table->id();
            $table->longText('uuid');
            // Relationships
            $table->longText('role_uuid');
            $table->longText('user_uuid')->nullable();
            $table->longText('password_uuid')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_users');
    }
};
