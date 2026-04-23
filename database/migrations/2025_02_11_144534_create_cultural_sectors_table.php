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
        if (!Schema::hasTable('cultural_sectors')) {
            Schema::create('cultural_sectors', function (Blueprint $table) {
                $table->id();
                $table->string('uuid');
                $table->string('name');
                $table->string('description')->nullable();
                $table->string('t_name')->default('cultural_sectors');
                $table->integer('version')->default(1);
                $table->integer('status')->default(1);
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
        Schema::dropIfExists('cultural_sector');
    }
};
