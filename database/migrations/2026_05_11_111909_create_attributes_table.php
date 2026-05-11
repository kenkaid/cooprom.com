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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name'); // Nom interne (ex: burida_number)
            $table->string('label'); // Libellé affiché (ex: Numéro BURIDA)
            $table->string('type')->default('text'); // text, number, date, select, etc.
            $table->text('options')->nullable(); // Pour les types 'select' (JSON)
            $table->boolean('is_required')->default(false);
            $table->string('validation_rules')->nullable();
            $table->string('allowed_roles')->nullable(); // Rôles autorisés (ex: artiste,organisation)
            $table->string('target_type')->default('user'); // Pour futures extensions
            $table->integer('order_column')->default(0);
            $table->integer('user_created_id')->default(0);
            $table->integer('user_updated_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
