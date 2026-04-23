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
        if (!Schema::hasTable('validations')) {
            Schema::create('validations', function (Blueprint $table) {
                $table->id()->autoIncrement();
                $table->string('uuid')->unique();
                $table->integer('user_id');
                $table->integer('artist_id');
                $table->date('submission_date');
                $table->date('validation_date');
                $table->string('observation');
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
        Schema::dropIfExists('validations');
    }
};
