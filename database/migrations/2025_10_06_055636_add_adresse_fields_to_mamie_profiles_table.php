<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('mamie_profiles', function (Blueprint $table) {
        $table->string('adresse')->nullable()->after('bio');
        $table->string('departement')->nullable()->after('adresse');
        $table->string('arrondissement')->nullable()->after('departement');
    });
}

public function down()
{
    Schema::table('mamie_profiles', function (Blueprint $table) {
        $table->dropColumn(['adresse', 'departement', 'arrondissement']);
    });
}
};
