<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\UploadsImages;
use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    use UploadsImages;

    /**
     * Show the site settings form.
     */
    public function edit(): View
    {
        $portfolio = config('portfolio');

        $settings = SiteSetting::query()->firstOrCreate([], [
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
            'meta_title' => $portfolio['meta_title'] ?? null,
            'meta_description' => $portfolio['meta_description'] ?? null,
            'canonical_url' => $portfolio['canonical_url'] ?? null,
            'og_type' => $portfolio['og_type'] ?? 'website',
            'og_image' => $portfolio['og_image'] ?? null,
            'twitter_handle' => $portfolio['twitter_handle'] ?? null,
            'organization_name' => $portfolio['organization_name'] ?? null,
            'organization_email' => $portfolio['organization_email'] ?? null,
            'organization_phone' => $portfolio['organization_phone'] ?? null,
            'organization_address' => $portfolio['organization_address'] ?? null,
            'geo_latitude' => $portfolio['geo_latitude'] ?? null,
            'geo_longitude' => $portfolio['geo_longitude'] ?? null,
            'timezone' => $portfolio['timezone'] ?? null,
            'language' => $portfolio['language'] ?? 'en',
        ]);

        return view('admin.settings.edit', ['settings' => $settings]);
    }

    /**
     * Persist the site settings (all editable site text + hero/about images).
     */
    public function update(Request $request): RedirectResponse
    {
        $settings = SiteSetting::query()->firstOrCreate([], [
            'logo' => config('portfolio.logo'),
        ]);

        $validated = $request->validate([
            'logo' => ['required', 'string', 'max:100'],
            'meta_title' => ['nullable', 'string', 'max:150'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'og_type' => ['nullable', 'string', 'max:50'],
            'og_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:4096'],
            'twitter_handle' => ['nullable', 'string', 'max:100'],
            'organization_name' => ['nullable', 'string', 'max:150'],
            'organization_email' => ['nullable', 'email', 'max:150'],
            'organization_phone' => ['nullable', 'string', 'max:50'],
            'organization_address' => ['nullable', 'string', 'max:255'],
            'geo_latitude' => ['nullable', 'string', 'max:50'],
            'geo_longitude' => ['nullable', 'string', 'max:50'],
            'timezone' => ['nullable', 'string', 'max:100'],
            'language' => ['nullable', 'string', 'max:10'],
            'role' => ['nullable', 'string', 'max:200'],
            'tagline' => ['nullable', 'string', 'max:500'],
            'availability' => ['nullable', 'string', 'max:150'],

            'hero_greeting' => ['nullable', 'string', 'max:100'],
            'hero_name' => ['nullable', 'string', 'max:100'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:4096'],
            'hero_chips' => ['nullable', 'string', 'max:500'],

            'about_tag' => ['nullable', 'string', 'max:100'],
            'about_heading' => ['nullable', 'string', 'max:200'],
            'about_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:4096'],
            'about_badge_value' => ['nullable', 'string', 'max:50'],
            'about_badge_label' => ['nullable', 'string', 'max:100'],
            'about_paragraphs' => ['nullable', 'string', 'max:5000'],

            'contact_heading' => ['nullable', 'string', 'max:200'],
            'contact_description' => ['nullable', 'string', 'max:500'],
            'contact_email' => ['nullable', 'email', 'max:150'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_phone_href' => ['nullable', 'string', 'max:50'],
            'contact_location' => ['nullable', 'string', 'max:150'],
            'contact_github_handle' => ['nullable', 'string', 'max:150'],
            'contact_github_href' => ['nullable', 'string', 'max:255'],
            'contact_linkedin_handle' => ['nullable', 'string', 'max:150'],
            'contact_linkedin_href' => ['nullable', 'string', 'max:255'],

            'footer_tagline' => ['nullable', 'string', 'max:200'],
            'footer_copyright' => ['nullable', 'string', 'max:200'],
        ]);

        $validated['hero_image'] = $this->uploadImage($request, 'hero_image', 'hero', $settings->hero_image);
        $validated['about_image'] = $this->uploadImage($request, 'about_image', 'about', $settings->about_image);
        $validated['og_image'] = $this->uploadImage($request, 'og_image', 'og', $settings->og_image);

        $settings->update($validated);
        PortfolioService::flush();

        return back()->with('status', 'Site settings saved — changes are live on the website.');
    }
}
