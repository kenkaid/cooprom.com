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
        Schema::table('events', function (Blueprint $table) {
            $table->decimal('budget_allocated', 15, 2)->nullable()->after('entry_fee');
            $table->decimal('actual_expenses', 15, 2)->nullable()->after('budget_allocated');
            $table->string('technical_file')->nullable()->after('image');
            $table->enum('new_status', ['draft', 'published', 'open_registration', 'ongoing', 'completed', 'cancelled'])->default('draft')->after('status');
        });

        // Migration des données si nécessaire, ici on remplace l'ancien enum par le nouveau
        DB::table('events')->update(['new_status' => DB::raw('status')]);

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('new_status', 'status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['budget_allocated', 'actual_expenses', 'technical_file']);
            // Note: Le changement d'enum est difficile à inverser proprement sans recréer la colonne
        });
    }
};
