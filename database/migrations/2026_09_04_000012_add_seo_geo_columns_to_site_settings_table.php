<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('meta_description');
            $table->string('og_type')->nullable()->after('canonical_url');
            $table->string('og_image')->nullable()->after('og_type');
            $table->string('twitter_handle')->nullable()->after('og_image');
            $table->string('organization_name')->nullable()->after('twitter_handle');
            $table->string('organization_email')->nullable()->after('organization_name');
            $table->string('organization_phone')->nullable()->after('organization_email');
            $table->string('organization_address')->nullable()->after('organization_phone');
            $table->string('geo_latitude')->nullable()->after('organization_address');
            $table->string('geo_longitude')->nullable()->after('geo_latitude');
            $table->string('timezone')->nullable()->after('geo_longitude');
            $table->string('language')->nullable()->after('timezone');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'canonical_url',
                'og_type',
                'og_image',
                'twitter_handle',
                'organization_name',
                'organization_email',
                'organization_phone',
                'organization_address',
                'geo_latitude',
                'geo_longitude',
                'timezone',
                'language',
            ]);
        });
    }
};
