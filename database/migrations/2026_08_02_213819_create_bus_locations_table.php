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
    Schema::create('bus_locations', function (Blueprint $table) {

        $table->id();

        $table->foreignId('bus_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->decimal('latitude', 10, 8);

        $table->decimal('longitude', 11, 8);

        $table->decimal('speed', 8, 2)
            ->nullable();

        $table->decimal('heading', 8, 2)
            ->nullable();

        $table->decimal('accuracy', 8, 2)
            ->nullable();

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_locations');
    }
};
