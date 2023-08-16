<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedBigInteger('collection_id');
            $table->tinyInteger('popularity')
                ->default(0);
            $table->string('image_url')
                ->nullable();
            $table->unsignedTinyInteger('a_red')
                ->nullable();
            $table->unsignedTinyInteger('a_blue')
                ->nullable();
            $table->unsignedTinyInteger('a_green')
                ->nullable();

            $table->timestamps();

            $table
                ->foreign('collection_id')
                ->references('id')
                ->on('collections');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
