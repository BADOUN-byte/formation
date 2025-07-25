<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('formations', function (Blueprint $table) {
        $table->string('nom_formateur')->nullable();
        $table->string('participants_pdf')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            //
        });
    }
};
