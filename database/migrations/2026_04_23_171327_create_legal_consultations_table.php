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
        Schema::create('legal_consultations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('subject');
            $table->text('message');
            $table->enum('category', ['copyright', 'contract', 'social', 'tax', 'other'])->default('other');
            $table->enum('status', ['pending', 'in_progress', 'answered', 'closed'])->default('pending');
            $table->text('admin_response')->nullable();
            $table->timestamp('answered_at')->nullable();
            $table->unsignedBigInteger('answered_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('answered_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_consultations');
    }
};
