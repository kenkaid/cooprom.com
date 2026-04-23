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
        Schema::table('contracts', function (Blueprint $table) {
            // Supprimer les colonnes de la migration précédente (si elles existent encore dans cet état de session)
            if (Schema::hasColumn('contracts', 'production_id')) {
                $table->dropForeign(['production_id']);
                $table->dropColumn('production_id');
            }
            if (Schema::hasColumn('contracts', 'visa_application_id')) {
                $table->dropForeign(['visa_application_id']);
                $table->dropColumn('visa_application_id');
            }

            // Ajouter les colonnes polymorphes
            $table->nullableMorphs('contractable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropMorphs('contractable');
            $table->unsignedBigInteger('production_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('visa_application_id')->nullable()->after('production_id');
        });
    }
};
