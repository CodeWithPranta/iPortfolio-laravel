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
        Schema::table('general_infos', function (Blueprint $table) {
            $table->string('favicon');
            $table->string('apple_touch_icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_infos', function (Blueprint $table) {
            $table->dropColumn(['favicon', 'apple_touch_icon']);
        });
    }
};
