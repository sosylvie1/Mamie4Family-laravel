<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin_profiles', function (Blueprint $table) {
            $table->id();

            // 🔗 Relation avec la table users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // 📞 Informations du profil admin
            $table->string('phone', 20)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 150)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('department', 100)->nullable();
            $table->string('position', 100)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_profiles');
    }
};
