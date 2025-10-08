<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('famille_profiles', function (Blueprint $table) {
            $table->string('ville')->nullable()->after('adresse');
            
            $table->string('arrondissement')->nullable()->after('departement');
        });
    }

    public function down(): void
    {
        Schema::table('famille_profiles', function (Blueprint $table) {
            $table->dropColumn(['ville',  'arrondissement']);
        });
    }
};

