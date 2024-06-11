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
        Schema::create('order_enfant_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('enfant_id')->nullable();
            $table->string('nom',50)->nullable();
            $table->string('prenom',50)->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('class_id');
            $table->decimal('school_insurance', 10, 2);
            $table->decimal('tution_fee_insurance', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('order_master');
            // $table->foreign('enfant_id')->references('id')->on('enfants');
            // $table->foreign('school_id')->references('id')->on('ecole');
            // $table->foreign('class_id')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_enfant_details');
    }
};
