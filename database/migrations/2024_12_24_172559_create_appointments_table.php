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
        if (!Schema::hasTable('appointments')) {
            Schema::create('appointments', function (Blueprint $table) {
                $table->id();
                $table->string('uuid');
                $table->unsignedBigInteger('artist_id');
                $table->unsignedBigInteger('object_id');
                $table->integer('stage')->default(1);
                $table->string('description')->nullable();
                $table->date('wish_date')->nullable();
                $table->string('t_name')->default('appointments');
                $table->integer('status')->default(1);
                $table->integer('version')->default(1);
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
        Schema::dropIfExists('appointments');
    }
};
