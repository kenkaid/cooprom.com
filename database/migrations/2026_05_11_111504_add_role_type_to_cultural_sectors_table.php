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
        Schema::table('cultural_sectors', function (Blueprint $table) {
            // On stockera les rôles autorisés sous forme de JSON ou de chaîne séparée par des virgules
            // Pour faire simple et flexible : 'artiste,organisation,individuel'
            $table->string('allowed_roles')->default('artiste,organisation,individuel')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cultural_sectors', function (Blueprint $table) {
            $table->dropColumn('allowed_roles');
        });
    }
};
