<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transformations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id');
            $table->string('image_url')
                ->nullable();
            $table->json('pattern')->nullable();
            $table->json('items')->nullable();
            $table->timestamps();

            $table
                ->foreign('collection_id')
                ->references('id')
                ->on('collections');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transformations');
    }
};
