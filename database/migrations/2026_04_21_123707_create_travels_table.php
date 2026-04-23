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
        if (!Schema::hasTable('travels')) {
            Schema::create('travels', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->string('title'); // Nom du voyage/mission
                $table->string('destination');
                $table->text('description')->nullable();
                $table->date('departure_date');
                $table->date('return_date')->nullable();
                $table->string('type')->default('group'); // group, individual
                $table->string('status')->default('planned'); // planned, ongoing, completed, cancelled
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
        Schema::dropIfExists('travels');
    }
};
