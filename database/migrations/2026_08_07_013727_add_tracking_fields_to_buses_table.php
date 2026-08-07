<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('buses', function (Blueprint $table) {

            $table->boolean('is_tracking')
                  ->default(false);

            $table->decimal('latitude',10,8)
                  ->nullable();

            $table->decimal('longitude',11,8)
                  ->nullable();

            $table->timestamp('last_update')
                  ->nullable();

        });
    }


    public function down(): void
    {
        Schema::table('buses', function (Blueprint $table) {

            $table->dropColumn([
                'is_tracking',
                'latitude',
                'longitude',
                'last_update'
            ]);

        });
    }
};
