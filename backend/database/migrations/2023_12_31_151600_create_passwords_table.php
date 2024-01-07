<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('passwords', function (Blueprint $table) {
            $table->id();
            $table->longText('uuid');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('pass');
            $table->longText('preferences')->nullable();
            $table->longText('login')->nullable();
            $table->longText('type_key')->nullable();
            $table->string('status_key')->nullable();
            $table->string('user_key')->nullable();
            $table->longText('img')->nullable();
            $table->timestamps();
            // SoftDeletes
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('passwords');
    }
};
