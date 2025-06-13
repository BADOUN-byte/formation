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

            $table->string('titre');             // titre de la formation
            $table->text('description')->nullable();

            $table->string('type');              // type (ex: Présentiel, distanciel, etc.)
            $table->string('lieu');

            $table->date('date_debut');          // date début
            $table->date('date_fin');            // date fin

            $table->integer('volume_horaire');

            $table->string('statut')->nullable();

            // Clés étrangères
            $table->foreignId('formateur_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');

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
