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
        Schema::create('retirement_simulations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('current_age')->nullable();
            $table->integer('target_retirement_age')->nullable();
            $table->decimal('estimated_monthly_pension', 15, 2)->nullable();
            $table->text('notes')->nullable();
            $table->string('document_path')->nullable(); // Pour le dépôt de documents
            $table->enum('status', ['draft', 'submitted', 'processed'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retirement_simulations');
    }
};
