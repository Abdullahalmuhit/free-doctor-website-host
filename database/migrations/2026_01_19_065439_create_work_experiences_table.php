<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('position'); // Professor, Consultant, etc.
            $table->string('institution'); // Hospital/College name
            $table->string('department')->nullable();
            $table->string('location')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable(); // NULL means current position
            $table->boolean('is_current')->default(false);
            $table->text('responsibilities')->nullable();
            $table->text('achievements')->nullable();
            $table->integer('order')->default(0); // Display order

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_experiences');
    }
};
