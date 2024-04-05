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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('sujet');
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('priorite_id');
            $table->unsignedBigInteger('statut_id');
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('assigned_to');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('priorite_id')->references('id')->on('priorites');
            $table->foreign('statut_id')->references('id')->on('statuts');
            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->foreign('assigned_to')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
