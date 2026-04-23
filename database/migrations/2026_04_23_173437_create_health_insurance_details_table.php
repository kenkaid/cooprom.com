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
        Schema::create('health_insurance_details', function (Blueprint $table) {
            $table->id();
            $table->string('partner_name');
            $table->string('insurance_type'); // Mutuelle, Prévoyance, etc.
            $table->text('description')->nullable();
            $table->text('coverage_details')->nullable();
            $table->string('contact_info')->nullable();
            $table->string('external_link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_insurance_details');
    }
};
