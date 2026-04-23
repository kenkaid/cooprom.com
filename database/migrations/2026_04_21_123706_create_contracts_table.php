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
        if (!Schema::hasTable('contracts')) {
            Schema::create('contracts', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->unsignedBigInteger('user_id'); // L'adhérent concerné
                $table->string('type'); // production, exposition, distribution, etc.
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('file_path')->nullable(); // Document PDF du contrat
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->string('status')->default('draft'); // draft, signed, expired, cancelled
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
        Schema::dropIfExists('contracts');
    }
};
