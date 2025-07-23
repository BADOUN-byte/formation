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

            // Clé étrangère vers services (nullable, null on delete)
            $table->foreignId('service_id')
                ->nullable()
                ->constrained('services')
                ->nullOnDelete();

            // Clé étrangère vers roles (non nullable, cascade on delete)
            $table->foreignId('role_id')
                ->constrained('roles')
                ->cascadeOnDelete();

            // Champ ajouté car utilisé dans seeders
            $table->boolean('is_active')->default(true);

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
    }
};
