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
        Schema::create('roles', function (Blueprint $table) {
            // ID manuel pour permettre des IDs fixes dans les seeders (ex : Role::ADMIN = 1)
            $table->unsignedBigInteger('id')->primary();

            // Nom du rôle : ex. admin, formateur, participant
            $table->string('nom')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
