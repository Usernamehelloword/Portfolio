<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'logo',
        'meta_title',
        'meta_description',
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
        'role',
        'tagline',
        'availability',
        'hero_greeting',
        'hero_name',
        'hero_image',
        'hero_chips',
        'about_tag',
        'about_heading',
        'about_image',
        'about_badge_value',
        'about_badge_label',
        'about_paragraphs',
        'contact_heading',
        'contact_description',
        'contact_email',
        'contact_phone',
        'contact_phone_href',
        'contact_location',
        'contact_github_handle',
        'contact_github_href',
        'contact_linkedin_handle',
        'contact_linkedin_href',
        'footer_tagline',
        'footer_copyright',
    ];
}
