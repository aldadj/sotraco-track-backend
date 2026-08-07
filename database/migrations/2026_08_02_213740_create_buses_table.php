<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('buses', function (Blueprint $table) {


            $table->id();


            $table->string('number')
                  ->unique();


            $table->string('line');


            $table->string('destination');


            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');



            // GPS

            $table->boolean('is_tracking')
                  ->default(false);



            $table->decimal('latitude',10,7)
                  ->nullable();



            $table->decimal('longitude',10,7)
                  ->nullable();



            $table->timestamp('last_update')
                  ->nullable();



            $table->timestamps();


        });

    }



    public function down(): void
    {

        Schema::dropIfExists('buses');

    }

};