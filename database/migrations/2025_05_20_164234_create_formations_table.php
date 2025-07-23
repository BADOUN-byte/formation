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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();

            $table->string('titre');             // Titre de la formation
            $table->text('description')->nullable();

            $table->enum('type', ['présentiel', 'distanciel', 'hybride'])->default('présentiel');
            $table->string('lieu');

            $table->date('date_debut');
            $table->date('date_fin');

            $table->integer('volume_horaire');   // En heures

            $table->enum('statut', ['en_attente', 'en_cours', 'terminée', 'annulée'])->default('en_attente');

            // Clés étrangères
            $table->foreignId('formateur_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('direction_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
