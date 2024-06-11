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
        Schema::create('enfants_view', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enfant_id');
            $table->string('nom', 50)->nullable();
            $table->string('prenom', 50)->nullable();
            $table->unsignedBigInteger('class_id');
            $table->string('class_name',100)->nullable();
            $table->unsignedBigInteger('ecole_id');
            $table->string('ecole_name',255)->nullable();
            $table->unsignedBigInteger('parent_id');
            $table->string('parent_nom', 100)->nullable();
            $table->string('parent_prenom', 100)->nullable();
            $table->string('assurance_scolaire',10)->nullable();
            $table->string('assurance_frais',10)->nullable();
            $table->string('attestation_num', 50)->nullable();
            $table->string('parent_telephone',50);
            $table->string('parent_email',100);
            $table->date('dob')->nullable();
            $table->string('adhesion',255)->nullable();
            $table->string('contribution',255)->nullable();
            $table->string('last_insurance_paid',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfants_view');
    }
};
