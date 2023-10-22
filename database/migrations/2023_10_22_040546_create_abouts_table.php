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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->json('dynamic_texts');
            $table->text('about_short_description');
            $table->string('professional_title');
            $table->text('profession_description');
            $table->date('birthday');
            $table->string('age');
            $table->string('website')->nullable();
            $table->string('degree');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->boolean('freelance')->default(true);
            $table->longText('about_yourself');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
