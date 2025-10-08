<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('familles');
        Schema::dropIfExists('mamies');
    }

    public function down(): void
    {
        // (facultatif : recréer la structure si rollback)
        Schema::create('familles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('ville')->nullable();
            $table->timestamps();
        });

        Schema::create('mamies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }
};

