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
        Schema::create('travels', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->string('destination');
            $table->foreignId('travel_status_id')->constrained()->onDelete('cascade');
            $table->foreignId('passenger_id')->constrained('profiles')->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('profiles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travels');
    }
};
