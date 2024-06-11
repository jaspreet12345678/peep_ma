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
        Schema::create('order_master', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10);
            $table->unsignedBigInteger('parent_id'); // Ensure this is unsigned
            $table->string('parent_nom', 50)->nullable();
            $table->string('parent_prenom', 50)->nullable();
            $table->string('parent_email', 100)->nullable();
            $table->string('parent_role', 50)->nullable();
            $table->string('parent_telephone', 50)->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('adhesion', 10, 2)->nullable();
            $table->decimal('contribution', 10, 2)->nullable();
            $table->string('mode', 10)->nullable();
            $table->integer('status')->default(0);
            $table->integer('user_id')->default(0);
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
        Schema::dropIfExists('order_master');
    }
};
