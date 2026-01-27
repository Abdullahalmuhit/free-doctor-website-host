<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('research_papers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('authors');
            $table->string('journal');
            $table->string('publication_date');
            $table->string('volume_issue')->nullable();
            $table->string('type')->default('article'); // article or case_report
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('research_papers');
    }
};
