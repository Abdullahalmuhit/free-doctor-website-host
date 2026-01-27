<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('degree'); // MBBS, MD, PhD, etc.
            $table->string('institution'); // University name
            $table->string('specialization')->nullable();
            $table->string('location')->nullable(); // City, Country
            $table->year('start_year')->nullable();
            $table->year('completion_year');
            $table->text('description')->nullable();
            $table->string('certificate_file')->nullable(); // Path to certificate
            $table->integer('order')->default(0); // Display order

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qualifications');
    }
};
