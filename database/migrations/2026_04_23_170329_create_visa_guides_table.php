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
        Schema::create('visa_guides', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('country');
            $table->string('visa_type')->nullable(); // Ex: Court séjour, Talent, etc.
            $table->text('description')->nullable();
            $table->text('required_documents')->nullable(); // Liste conseillée
            $table->text('procedure_steps')->nullable(); // Étapes à suivre
            $table->string('useful_links')->nullable(); // JSON ou texte
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('user_created_id')->nullable();
            $table->unsignedBigInteger('user_updated_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_created_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_updated_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_guides');
    }
};
