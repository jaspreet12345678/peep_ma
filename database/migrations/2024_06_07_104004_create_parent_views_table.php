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
        Schema::create('parent_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->bigInteger('membership_number')->default(0);
            $table->string('parent_name', 100)->nullable();
            $table->string('parent_email', 150)->nullable();
            $table->string('password')->nullable();
            $table->string('parent_telephone')->nullable();
            $table->string('member_adherent', 50)->nullable();
            $table->string('insured_child')->nullable();
            $table->integer('number_child')->default(0);
            $table->string('role')->nullable();
            $table->string('school')->nullable();
            $table->string('school_ids')->nullable();
            $table->string('class_names')->nullable();
            $table->string('class_ids')->nullable();
            $table->timestamps();

            // Add the foreign key constraint
            $table->foreign('parent_id')->references('id')->on('parents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_views');
    }
};
