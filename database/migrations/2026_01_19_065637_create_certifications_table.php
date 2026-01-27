<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('certification_name');
            $table->string('issuing_organization');
            $table->string('credential_id')->nullable();
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->boolean('does_not_expire')->default(false);
            $table->string('certification_url')->nullable();
            $table->string('certificate_file')->nullable();
            $table->integer('order')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certifications');
    }
};
