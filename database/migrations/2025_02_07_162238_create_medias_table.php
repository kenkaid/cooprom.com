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
        if (!Schema::hasTable('medias')) {
            Schema::create('medias', function (Blueprint $table) {
                $table->id();
                $table->string('uuid');
                $table->string('description')->nullable();
                $table->string('type')->default('video');
                $table->string('extension');
                $table->string('file');
                $table->string('t_name')->default('medias');
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
        Schema::dropIfExists('medias');
    }
};
