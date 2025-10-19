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
        Schema::create('shares', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name_share');
            $table->string('name_book');
            $table->foreignId('typebook_id')->constrained('typebooks')->onDelete('cascade');
            $table->string('description')->nullable();
            $table->string('filebook')->nullable();
            $table->string('flip_url')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shares');
    }
};
