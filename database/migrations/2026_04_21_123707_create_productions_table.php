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
        if (!Schema::hasTable('productions')) {
            Schema::create('productions', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->unsignedBigInteger('user_id'); // Artiste/Adhérent principal
                $table->string('title');
                $table->string('type'); // clip, film, reportage, virtual_gallery, digital_work, etc.
                $table->text('description')->nullable();
                $table->string('status')->default('pending'); // pending, in_progress, completed, published
                $table->decimal('budget', 15, 2)->nullable();
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
        Schema::dropIfExists('productions');
    }
};
