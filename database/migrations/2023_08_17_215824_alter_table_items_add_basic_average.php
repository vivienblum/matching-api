<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items', static function (Blueprint $table) {
            $table->unsignedTinyInteger('ab_red')
                ->nullable();
            $table->unsignedTinyInteger('ab_green')
                ->nullable();
            $table->unsignedTinyInteger('ab_blue')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('items', static function (Blueprint $table) {
            $table->dropColumn('ab_red');
            $table->dropColumn('ab_green');
            $table->dropColumn('ab_blue');
        });
    }
};
