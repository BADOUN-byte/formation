<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('matricule')->nullable();
            $table->string('grade')->nullable();
            $table->string('fonction')->nullable();

            $table->foreignId('role_id')
                ->constrained('roles') // on précise la table au cas où
                ->onDelete('cascade');

            $table->foreignId('service_id')
                ->nullable()
                ->constrained('services')
                ->nullOnDelete(); // plus lisible que onDelete('set null')

            $table->rememberToken(); // Pour la persistance des sessions
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
