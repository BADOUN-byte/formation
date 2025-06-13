<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('formation_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Pour indiquer s'il s'agit d'un participant ou d'un formateur dans le cadre de cette formation
            $table->enum('role_in_formation', ['formateur', 'participant']);

            $table->timestamps();

            // Empêche les doublons (même user avec même rôle dans la même formation)
            $table->unique(['formation_id', 'user_id', 'role_in_formation']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formation_user');
    }
};
