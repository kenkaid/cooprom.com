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
        Schema::table('users', function (Blueprint $table) {
            // Communs
            $table->string('role_type')->default('artiste')->after('email'); // artiste, organisation, individuel
            $table->string('habitation_place')->nullable()->after('address');

            // Artiste
            $table->string('burida_number')->nullable()->after('role_type');
            $table->string('cni_number')->nullable()->after('burida_number');
            $table->string('pseudonym')->nullable()->after('cni_number');

            // Organisation
            $table->string('company_name')->nullable()->after('pseudonym');
            $table->string('manager_name')->nullable()->after('company_name');
            $table->string('registration_number_mc')->nullable()->after('manager_name');
            $table->string('implementation_place')->nullable()->after('registration_number_mc');

            // Individuel
            $table->string('cnps_number')->nullable()->after('implementation_place');
            $table->string('profession')->nullable()->after('cnps_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role_type',
                'habitation_place',
                'burida_number',
                'cni_number',
                'pseudonym',
                'company_name',
                'manager_name',
                'registration_number_mc',
                'implementation_place',
                'cnps_number',
                'profession'
            ]);
        });
    }
};
