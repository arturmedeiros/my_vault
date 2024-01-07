<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vault_types', function (Blueprint $table) {
            $table->id();
            $table->longText('uuid');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('preferences')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vault_types');
    }
};
