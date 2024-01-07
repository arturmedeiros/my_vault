<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->longText('uuid');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('preferences')->nullable();
            $table->longText('permissions')->nullable();
            $table->integer('status_key')->unsigned()->nullable()->default(1); // 0 (Enable) or 1 (Disable)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
