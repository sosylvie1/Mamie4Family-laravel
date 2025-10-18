<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enfants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('famille_profile_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->integer('age');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enfants');
    }
};

