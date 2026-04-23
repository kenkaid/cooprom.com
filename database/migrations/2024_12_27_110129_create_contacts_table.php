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
        if (!Schema::hasTable('contacts')) {
            Schema::create('contacts', function (Blueprint $table) {
                $table->id();
                $table->string('uuid');
                $table->string('name');
                $table->string('last_name');
                $table->string('email');
                $table->string('phone');
                $table->longText('message');
                $table->string('t_name')->default('contacts');
                $table->integer('status')->default(1);
                $table->integer('version')->default(1);
                $table->integer('user_created_id')->default(1);
                $table->integer('user_updated_id')->default(1);
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
        Schema::dropIfExists('contacts');
    }
};
