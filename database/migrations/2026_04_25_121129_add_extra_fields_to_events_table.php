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
            $table->enum('status', ['draft', 'published', 'open_registration', 'ongoing', 'completed', 'cancelled'])->default('draft')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'budget_allocated')) {
                $table->dropColumn('budget_allocated');
            }
            if (Schema::hasColumn('events', 'actual_expenses')) {
                $table->dropColumn('actual_expenses');
            }
            if (Schema::hasColumn('events', 'technical_file')) {
                $table->dropColumn('technical_file');
            }
        });

        // Optionnel : Nettoyer les statuts qui n'existent pas dans l'ancienne version avant de changer le type
        DB::table('events')->whereNotIn('status', ['draft', 'published', 'ongoing', 'completed', 'cancelled'])->update(['status' => 'draft']);

        Schema::table('events', function (Blueprint $table) {
            $table->enum('status', ['draft', 'published', 'ongoing', 'completed', 'cancelled'])->default('draft')->change();
        });
    }
};
