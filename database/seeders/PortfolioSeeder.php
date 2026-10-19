<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

/**
 * Imports the current website content from config/portfolio.php into the
 * database so the admin panel can manage it.
 *
 * - On a fresh database it seeds every table.
 * - Tables that already have rows are left untouched.
 * - Use `php artisan portfolio:reseed` to reset content to config defaults.
 */
class PortfolioSeeder extends Seeder
{
    use PortfolioSeederHelpers;
    use PortfolioSeederPart2;

    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $portfolio = config('portfolio');

        if (SiteSetting::query()->exists()) {
            $this->command?->line('  <comment>Site settings already exist — skipped.</comment>');
        } else {
            SiteSetting::create([
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
            ]);
            $this->command?->line('  <info>Site settings seeded.</info>');
        }

        $this->seedNavLinks($portfolio);
        $this->seedStats($portfolio);
        $this->seedSocials($portfolio);
        $this->seedSkills($portfolio);
        $this->seedProjects($portfolio);
        $this->seedExperiences($portfolio);
        $this->seedServices($portfolio);
    }
}
