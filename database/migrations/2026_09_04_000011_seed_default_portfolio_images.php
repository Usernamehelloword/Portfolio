<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Data migration — stores the default portfolio images in the database.
 *
 * The default image references (hero, about and project images) are inserted
 * here via migrations, so the images exist in the database even when no
 * seeder is run. Existing rows are left untouched.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $portfolio = config('portfolio');

        // ------------------------------------------------------------------
        // Site settings — single row holding hero + about images.
        // ------------------------------------------------------------------
        if (DB::table('site_settings')->count() === 0) {
            DB::table('site_settings')->insert([
                'logo' => $portfolio['logo'],
                'role' => $portfolio['role'],
                'tagline' => $portfolio['tagline'],
                'availability' => $portfolio['availability'],
                'hero_greeting' => $portfolio['hero']['greeting'],
                'hero_name' => $portfolio['hero']['name'],
                'hero_image' => $portfolio['hero']['image'],
                'hero_chips' => implode(', ', $portfolio['hero']['chips']),
                'about_tag' => $portfolio['about']['tag'],
                'about_heading' => $portfolio['about']['heading'],
                'about_image' => $portfolio['about']['image'],
                'about_badge_value' => $portfolio['about']['badge_value'],
                'about_badge_label' => $portfolio['about']['badge_label'],
                'about_paragraphs' => implode("\n", $portfolio['about']['paragraphs']),
                'contact_heading' => $portfolio['contact']['heading'],
                'contact_description' => $portfolio['contact']['description'],
                'contact_email' => $portfolio['contact']['email'],
                'contact_phone' => $portfolio['contact']['phone'],
                'contact_phone_href' => $portfolio['contact']['phone_href'],
                'contact_location' => $portfolio['contact']['location'],
                'contact_github_handle' => $portfolio['contact']['github']['handle'],
                'contact_github_href' => $portfolio['contact']['github']['href'],
                'contact_linkedin_handle' => $portfolio['contact']['linkedin']['handle'],
                'contact_linkedin_href' => $portfolio['contact']['linkedin']['href'],
                'footer_tagline' => $portfolio['footer']['tagline'],
                'footer_copyright' => $portfolio['footer']['copyright'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ------------------------------------------------------------------
        // Projects — the project card images.
        // ------------------------------------------------------------------
        if (DB::table('projects')->count() === 0) {
            foreach ($portfolio['projects'] as $index => $project) {
                DB::table('projects')->insert([
                    'name' => $project['name'],
                    'description' => $project['description'],
                    'image' => $project['image'],
                    'technologies' => implode(', ', $project['technologies']),
                    'github' => $project['github'],
                    'demo' => $project['demo'],
                    'sort_order' => $index,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // The default rows live in site_settings / projects. Only remove them
        // when they still match the untouched defaults from config.
        $portfolio = config('portfolio');

        DB::table('site_settings')
            ->where('hero_image', $portfolio['hero']['image'])
            ->where('about_image', $portfolio['about']['image'])
            ->delete();

        foreach ($portfolio['projects'] as $project) {
            DB::table('projects')
                ->where('name', $project['name'])
                ->where('image', $project['image'])
                ->delete();
        }
    }
};