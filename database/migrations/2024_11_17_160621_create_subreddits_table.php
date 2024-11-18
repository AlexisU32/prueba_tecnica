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
        Schema::create('subreddits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reddit_id')->constrained('reddits')->onDelete('cascade'); // Relación con la tabla reddits
            $table->string('display_name');
            $table->string('header_img')->nullable();
            $table->string('banner_img')->nullable();
            $table->string('submit_text_html')->nullable();
            $table->integer('subscribers')->nullable(); // Número de suscriptores
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subreddits');
    }
};
