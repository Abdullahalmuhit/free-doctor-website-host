<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chambers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('room_number')->nullable();
            $table->text('address');
            $table->string('phone');
            $table->json('visiting_hours'); // [{"day": "Saturday", "time": "6:00 PM - 9:00 PM"}]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chambers');
    }
};
