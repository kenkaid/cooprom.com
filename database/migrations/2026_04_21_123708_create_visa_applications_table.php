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
        if (!Schema::hasTable('visa_applications')) {
            Schema::create('visa_applications', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->unsignedBigInteger('user_id'); // L'adhérent qui demande le visa
                $table->unsignedBigInteger('travel_id')->nullable(); // Optionnel : lié à un voyage spécifique
                $table->string('country'); // Pays de destination
                $table->string('visa_type'); // Type de visa demandé
                $table->text('required_documents')->nullable(); // Liste ou JSON des docs requis
                $table->string('status')->default('pending'); // pending, submitted, approved, rejected
                $table->date('submission_date')->nullable();
                $table->integer('user_created_id');
                $table->integer('user_updated_id');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_applications');
    }
};
