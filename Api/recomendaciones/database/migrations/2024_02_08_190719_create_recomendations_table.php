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
        Schema::create('recomendations', function (Blueprint $table) {
            $table->id();
            $table->integer('place_id');
            $table->integer('comment_id');
            $table->integer('rating_id');
            $table->String('imagen');
            $table->timestamps();

            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('comment_id')->references('id')->on('comments');
            $table->foreign('rating_id')->references('id')->on('ratings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomendations');
    }
};
