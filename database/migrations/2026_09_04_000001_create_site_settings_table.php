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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            // General
            $table->string('logo', 100);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('role')->nullable();
            $table->text('tagline')->nullable();
            $table->string('availability')->nullable();

            // Hero
            $table->string('hero_greeting')->nullable();
            $table->string('hero_name')->nullable();
            $table->string('hero_image')->nullable();
            $table->text('hero_chips')->nullable();

            // About
            $table->string('about_tag')->nullable();
            $table->string('about_heading')->nullable();
            $table->string('about_image')->nullable();
            $table->string('about_badge_value', 50)->nullable();
            $table->string('about_badge_label')->nullable();
            $table->text('about_paragraphs')->nullable();

            // Contact
            $table->string('contact_heading')->nullable();
            $table->text('contact_description')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_phone_href')->nullable();
            $table->string('contact_location')->nullable();
            $table->string('contact_github_handle')->nullable();
            $table->string('contact_github_href')->nullable();
            $table->string('contact_linkedin_handle')->nullable();
            $table->string('contact_linkedin_href')->nullable();

            // Footer
            $table->string('footer_tagline')->nullable();
            $table->string('footer_copyright')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
