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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 15, 2)->nullable();
            $table->string('price_unit', 50)->nullable();
            $table->string('type')->nullable();
            $table->foreignId('provider_id')->constrained('providers')->cascadeOnDelete();
            $table->longText('description')->nullable();
            $table->json('features')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
