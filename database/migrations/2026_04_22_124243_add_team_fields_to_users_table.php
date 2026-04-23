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
        Schema::table('users', function (Blueprint $table) {
            $table->string('designation')->nullable()->after('last_name'); // Pour le staff/team
            $table->string('facebook')->nullable()->after('phone_number');
            $table->string('twitter')->nullable()->after('facebook');
            $table->string('linkedin')->nullable()->after('twitter');
            $table->string('vimeo')->nullable()->after('linkedin');
            $table->integer('status')->default(1)->after('vimeo'); // 1: Actif, 0: Inactif
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['designation', 'facebook', 'twitter', 'linkedin', 'vimeo', 'status']);
        });
    }
};
