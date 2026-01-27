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
        Schema::table('chambers', function (Blueprint $table) {
            $table->integer('slot_duration')->default(10)->after('visiting_hours'); // Minutes per slot
            $table->integer('max_patients_per_slot')->default(1)->after('slot_duration'); // Allow multiple bookings
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chambers', function (Blueprint $table) {
            $table->dropColumn(['slot_duration', 'max_patients_per_slot']);
        });
    }
};
