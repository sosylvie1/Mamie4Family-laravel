<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mamie_profiles', function (Blueprint $table) {
            $table->string('cni')->nullable()->after('photo'); // stockage du fichier
        });
    }

    public function down(): void
    {
        Schema::table('mamie_profiles', function (Blueprint $table) {
            $table->dropColumn('cni');
        });
    }
};
