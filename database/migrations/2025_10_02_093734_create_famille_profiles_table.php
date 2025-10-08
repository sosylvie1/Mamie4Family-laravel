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
    Schema::create('famille_profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // Infos principales
        $table->string('adresse')->nullable();
        $table->string('departement')->nullable();
        $table->string('telephone')->nullable();

        // Infos enfants
        $table->integer('nombre_enfants')->nullable();
        $table->json('enfants')->nullable(); 
        // -> stockera un tableau [{"prenom":"Paul","age":8},{"prenom":"Emma","age":6}]

        $table->timestamps();
    });
}

};
