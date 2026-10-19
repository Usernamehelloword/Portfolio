<?php

namespace App\Services;

use App\Models\Experience;
use App\Models\NavLink;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SkillGroup;
use App\Models\Social;
use App\Models\Stat;
use Illuminate\Support\Facades\Cache;

/**
 * Builds the `$portfolio` array consumed by the front-end views.
 *
 * Content lives in the database (editable from the admin panel). Any value
 * missing from the database gracefully falls back to config/portfolio.php.
 */
class PortfolioService
{
    public const CACHE_KEY = 'portfolio.content';

    /**
     * Get the assembled portfolio content (cached).
     */
    public function content(): array
    {
        return Cache::remember(self::CACHE_KEY, now()->addHours(6), function () {
            return $this->build();
        });
    }

    /**
     * Drop the cached content — call after any admin content mutation.
     */
    public static function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Assemble content from the database, falling back to config defaults.
     */
    protected function build(): array
    {
        $defaults = config('portfolio');
        $settings = SiteSetting::query()->first() ?? new SiteSetting;

        $navLinks = NavLink::query()->orderBy('sort_order')->orderBy('id')->get();
        $stats = Stat::query()->orderBy('sort_order')->orderBy('id')->get();
        $socials = Social::query()->orderBy('sort_order')->orderBy('id')->get();
        $groups = SkillGroup::query()->with('skills')->orderBy('sort_order')->orderBy('id')->get();
        $projects = Project::query()->orderBy('sort_order')->orderBy('id')->get();
        $experiences = Experience::query()->orderBy('sort_order')->orderBy('id')->get();
        $services = Service::query()->orderBy('sort_order')->orderBy('id')->get();

        $content = $defaults;

        $content['logo'] = filled($settings->logo) ? $settings->logo : $defaults['logo'];
        $content['role'] = filled($settings->role) ? $settings->role : $defaults['role'];
        $content['tagline'] = filled($settings->tagline) ? $settings->tagline : $defaults['tagline'];
        $content['availability'] = filled($settings->availability) ? $settings->availability : $defaults['availability'];
        $content['meta_title'] = $settings->meta_title;
        $content['meta_description'] = filled($settings->meta_description)
            ? $settings->meta_description
            : 'Kimlay — Full-Stack Developer & Creative Problem Solver building modern, responsive, high-performance web applications.';
        $content['canonical_url'] = filled($settings->canonical_url) ? $settings->canonical_url : ($defaults['canonical_url'] ?? url('/'));
        $content['og_type'] = filled($settings->og_type) ? $settings->og_type : ($defaults['og_type'] ?? 'website');
        $content['og_image'] = filled($settings->og_image) ? $settings->og_image : ($defaults['og_image'] ?? 'images/hero-avatar.svg');
        $content['twitter_handle'] = filled($settings->twitter_handle) ? $settings->twitter_handle : ($defaults['twitter_handle'] ?? null);
        $content['organization_name'] = filled($settings->organization_name) ? $settings->organization_name : ($defaults['organization_name'] ?? null);
        $content['organization_email'] = filled($settings->organization_email) ? $settings->organization_email : ($defaults['organization_email'] ?? null);
        $content['organization_phone'] = filled($settings->organization_phone) ? $settings->organization_phone : ($defaults['organization_phone'] ?? null);
        $content['organization_address'] = filled($settings->organization_address) ? $settings->organization_address : ($defaults['organization_address'] ?? null);
        $content['geo_latitude'] = filled($settings->geo_latitude) ? $settings->geo_latitude : ($defaults['geo_latitude'] ?? null);
        $content['geo_longitude'] = filled($settings->geo_longitude) ? $settings->geo_longitude : ($defaults['geo_longitude'] ?? null);
        $content['timezone'] = filled($settings->timezone) ? $settings->timezone : ($defaults['timezone'] ?? null);
        $content['language'] = filled($settings->language) ? $settings->language : ($defaults['language'] ?? 'en');

        $content['nav'] = $navLinks->isNotEmpty()
            ? $navLinks->map(fn (NavLink $link) => [
                'label' => $link->label,
                'href' => $link->href,
            ])->all()
            : $defaults['nav'];

        $content['hero'] = [
            'greeting' => filled($settings->hero_greeting) ? $settings->hero_greeting : $defaults['hero']['greeting'],
            'name' => filled($settings->hero_name) ? $settings->hero_name : $defaults['hero']['name'],
            'image' => filled($settings->hero_image) ? $settings->hero_image : $defaults['hero']['image'],
            'chips' => filled($settings->hero_chips)
                ? $this->splitList($settings->hero_chips)
                : $defaults['hero']['chips'],
        ];

        $content['about'] = [
            'tag' => filled($settings->about_tag) ? $settings->about_tag : $defaults['about']['tag'],
            'heading' => filled($settings->about_heading) ? $settings->about_heading : $defaults['about']['heading'],
            'image' => filled($settings->about_image) ? $settings->about_image : $defaults['about']['image'],
            'badge_value' => filled($settings->about_badge_value) ? $settings->about_badge_value : $defaults['about']['badge_value'],
            'badge_label' => filled($settings->about_badge_label) ? $settings->about_badge_label : $defaults['about']['badge_label'],
            'paragraphs' => filled($settings->about_paragraphs)
                ? $this->splitParagraphs($settings->about_paragraphs)
                : $defaults['about']['paragraphs'],
            'stats' => $stats->isNotEmpty()
                ? $stats->map(fn (Stat $stat) => [
                    'value' => $stat->value,
                    'suffix' => (string) $stat->suffix,
                    'label' => $stat->label,
                ])->all()
                : $defaults['about']['stats'],
        ];

        $content['skills'] = $groups->isNotEmpty()
            ? $groups->map(fn (SkillGroup $group) => [
                'category' => $group->category,
                'icon' => $group->icon,
                'blurb' => (string) $group->blurb,
                'items' => $group->skills->map(fn ($skill) => [
                    'name' => $skill->name,
                    'abbr' => $skill->abbr,
                    'level' => $skill->level,
                    'color' => $skill->color,
                ])->all(),
            ])->all()
            : $defaults['skills'];

        $content['projects'] = $projects->isNotEmpty()
            ? $projects->map(fn (Project $project) => [
                'name' => $project->name,
                'description' => $project->description,
                'image' => $project->image,
                'technologies' => $this->splitList((string) $project->technologies),
                'github' => (string) $project->github,
                'demo' => (string) $project->demo,
            ])->all()
            : $defaults['projects'];

        $content['experience'] = $experiences->isNotEmpty()
            ? $experiences->map(fn (Experience $item) => [
                'period' => $item->period,
                'title' => $item->title,
                'description' => $item->description,
                'current' => $item->is_current,
            ])->all()
            : $defaults['experience'];

        $content['services'] = $services->isNotEmpty()
            ? $services->map(fn (Service $service) => [
                'icon' => $service->icon,
                'title' => $service->title,
                'description' => $service->description,
            ])->all()
            : $defaults['services'];

        $content['contact'] = [
            'heading' => filled($settings->contact_heading) ? $settings->contact_heading : $defaults['contact']['heading'],
            'description' => filled($settings->contact_description) ? $settings->contact_description : $defaults['contact']['description'],
            'email' => filled($settings->contact_email) ? $settings->contact_email : $defaults['contact']['email'],
            'phone' => filled($settings->contact_phone) ? $settings->contact_phone : $defaults['contact']['phone'],
            'phone_href' => filled($settings->contact_phone_href) ? $settings->contact_phone_href : $defaults['contact']['phone_href'],
            'location' => filled($settings->contact_location) ? $settings->contact_location : $defaults['contact']['location'],
            'github' => [
                'label' => $defaults['contact']['github']['label'],
                'handle' => filled($settings->contact_github_handle) ? $settings->contact_github_handle : $defaults['contact']['github']['handle'],
                'href' => filled($settings->contact_github_href) ? $settings->contact_github_href : $defaults['contact']['github']['href'],
            ],
            'linkedin' => [
                'label' => $defaults['contact']['linkedin']['label'],
                'handle' => filled($settings->contact_linkedin_handle) ? $settings->contact_linkedin_handle : $defaults['contact']['linkedin']['handle'],
                'href' => filled($settings->contact_linkedin_href) ? $settings->contact_linkedin_href : $defaults['contact']['linkedin']['href'],
            ],
        ];

        $content['socials'] = $socials->isNotEmpty()
            ? $socials->map(fn (Social $social) => [
                'label' => $social->label,
                'icon' => $social->icon,
                'href' => $social->href,
            ])->all()
            : $defaults['socials'];

        $content['footer'] = [
            'tagline' => filled($settings->footer_tagline) ? $settings->footer_tagline : $defaults['footer']['tagline'],
            'copyright' => filled($settings->footer_copyright) ? $settings->footer_copyright : $defaults['footer']['copyright'],
        ];

        return $content;
    }

    /**
     * "React, Node, MySQL" → ['React', 'Node', 'MySQL']
     *
     * @return list<string>
     */
    protected function splitList(string $value): array
    {
        return array_values(array_filter(
            array_map('trim', explode(',', $value)),
            fn (string $item) => $item !== ''
        ));
    }

    /**
     * A textarea with one paragraph per line → list of paragraphs.
     *
     * @return list<string>
     */
    protected function splitParagraphs(string $value): array
    {
        return array_values(array_filter(
            array_map('trim', preg_split('/\R+/', $value) ?: []),
            fn (string $paragraph) => $paragraph !== ''
        ));
    }
}
