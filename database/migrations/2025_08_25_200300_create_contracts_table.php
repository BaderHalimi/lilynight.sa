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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('date');
            $table->text('content');
            $table->enum('status', ['pending', 'cancelled', 'finished'])->default('pending');
            $table->text('provider_signature')->nullable();
            $table->text('customer_signature')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('provider_id')->constrained('providers')->cascadeOnDelete();


            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
