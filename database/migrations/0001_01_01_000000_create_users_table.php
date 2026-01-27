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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Basic Authentication
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // Personal Information
            $table->string('name');
            $table->string('designation')->nullable(); // e.g., "Senior Consultant - Neurology"
            $table->string('title')->default('Dr.'); // Dr., Prof. Dr., etc.
            $table->string('profile_photo')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_secondary')->nullable();
            $table->string('emergency_contact')->nullable();

            // Professional Information
            $table->text('bio')->nullable(); // Short professional bio
            $table->text('about')->nullable(); // Detailed about section
            $table->string('specialization')->nullable(); // Main specialization
            $table->integer('years_of_experience')->nullable();
            $table->string('medical_license_number')->nullable();
            $table->date('license_issue_date')->nullable();
            $table->date('license_expiry_date')->nullable();

            // Contact & Address
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->default('Bangladesh');
            $table->string('postal_code')->nullable();

            // Social Media & Web Presence
            $table->string('website')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();

            // Professional Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_accepting_patients')->default(true);
            $table->string('consultation_fee')->nullable();
            $table->string('follow_up_fee')->nullable();

            // Metadata
            $table->string('role')->default('doctor'); // doctor, admin, staff
            $table->json('languages_spoken')->nullable(); // ["English", "Bengali", "Hindi"]
            $table->json('consultation_types')->nullable(); // ["In-person", "Online", "Home Visit"]

            $table->timestamps();
            $table->softDeletes(); // For soft delete functionality
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
