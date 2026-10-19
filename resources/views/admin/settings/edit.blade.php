@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">General</h2>
                <p class="panel__hint">Logo text, browser title and short description used in the page head.</p>
            </div>

            <div class="form-grid">
                <x-admin::field name="logo" label="Logo text" required :value="$settings->logo" placeholder="KIMLAY." hint="Shown in the navbar and footer." />
                <x-admin::field name="availability" label="Availability badge" :value="$settings->availability" placeholder="Available for freelance projects" />
            </div>
            <div class="form-grid form-grid--stack">
                <x-admin::field name="role" label="Role (hero subtitle)" :value="$settings->role" placeholder="Full-Stack Developer & Creative Problem Solver" />
                <x-admin::textarea name="tagline" label="Tagline (hero description)" :value="$settings->tagline" :rows="2" />
            </div>
            <div class="form-grid">
                <x-admin::field name="meta_title" label="Browser tab title (SEO)" :value="$settings->meta_title" placeholder="Kimlay — Full-Stack Developer" />
                <x-admin::field name="meta_description" label="Meta description (SEO)" :value="$settings->meta_description" />
            </div>
            <div class="form-grid">
                <x-admin::field name="canonical_url" label="Canonical URL" :value="$settings->canonical_url" placeholder="https://kimlay.dev" />
                <x-admin::field name="og_type" label="Open Graph type" :value="$settings->og_type" placeholder="website" />
            </div>
            <div class="form-grid">
                <x-admin::field name="twitter_handle" label="Twitter handle" :value="$settings->twitter_handle" placeholder="@kimlay" />
                <x-admin::image name="og_image" label="Open Graph image" :current="$settings->og_image" />
            </div>
        </div>

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Organization &amp; GEO</h2>
                <p class="panel__hint">Business contact details and geographic data used for local SEO and structured data.</p>
            </div>

            <div class="form-grid">
                <x-admin::field name="organization_name" label="Organization name" :value="$settings->organization_name" placeholder="Kimlay" />
                <x-admin::field name="organization_email" label="Organization email" type="email" :value="$settings->organization_email" placeholder="Chhunkimlay248@email.co" />
            </div>
            <div class="form-grid">
                <x-admin::field name="organization_phone" label="Organization phone" :value="$settings->organization_phone" placeholder="+855 14 549 059" />
                <x-admin::field name="organization_address" label="Organization address" :value="$settings->organization_address" placeholder="Phnom Penh, Cambodia" />
            </div>
            <div class="form-grid">
                <x-admin::field name="geo_latitude" label="Latitude" :value="$settings->geo_latitude" placeholder="11.5564" />
                <x-admin::field name="geo_longitude" label="Longitude" :value="$settings->geo_longitude" placeholder="104.9282" />
            </div>
            <div class="form-grid">
                <x-admin::field name="timezone" label="Timezone" :value="$settings->timezone" placeholder="Asia/Phnom_Penh" />
                <x-admin::field name="language" label="Language code" :value="$settings->language" placeholder="en" />
            </div>
        </div>

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Hero section</h2>
                <p class="panel__hint">The first thing visitors see at the top of the page.</p>
            </div>

            <div class="form-grid">
                <x-admin::field name="hero_greeting" label="Greeting line" :value="$settings->hero_greeting" placeholder="Hello, I'm" />
                <x-admin::field name="hero_name" label="Your name" :value="$settings->hero_name" placeholder="Kimlay" />
            </div>
            <div class="form-grid">
                <x-admin::image name="hero_image" label="Hero image" :current="$settings->hero_image" />
                <x-admin::textarea name="hero_chips" label="Floating chips" :value="$settings->hero_chips" :rows="2" hint="Comma separated, e.g. HTML, CSS, JavaScript, Laravel" />
            </div>
        </div>

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">About section</h2>
                <p class="panel__hint">Your story, portrait and the animated stats (managed under About Stats).</p>
            </div>

            <div class="form-grid">
                <x-admin::field name="about_tag" label="Section tag" :value="$settings->about_tag" placeholder="About Me" />
                <x-admin::field name="about_heading" label="Section heading" :value="$settings->about_heading" placeholder="A little about me" />
            </div>
            <div class="form-grid">
                <x-admin::field name="about_badge_value" label="Badge value" :value="$settings->about_badge_value" placeholder="3+" />
                <x-admin::field name="about_badge_label" label="Badge label" :value="$settings->about_badge_label" placeholder="Years of Experience" />
            </div>
            <div class="form-grid form-grid--stack">
                <x-admin::textarea
                    name="about_paragraphs"
                    label="About paragraphs"
                    :value="$settings->about_paragraphs"
                    :rows="6"
                    hint="One paragraph per line — each line becomes its own paragraph."
                />
            </div>
            <div class="form-grid">
                <x-admin::image name="about_image" label="About image" :current="$settings->about_image" />
            </div>
        </div>

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Contact section</h2>
                <p class="panel__hint">Contact details shown next to the contact form.</p>
            </div>

            <div class="form-grid">
                <x-admin::field name="contact_heading" label="Contact heading" :value="$settings->contact_heading" />
                <x-admin::field name="contact_description" label="Contact description" :value="$settings->contact_description" />
            </div>
            <div class="form-grid">
                <x-admin::field name="contact_email" label="Email" type="email" :value="$settings->contact_email" />
                <x-admin::field name="contact_phone" label="Phone (display)" :value="$settings->contact_phone" placeholder="+855 12 345 678" />
            </div>
            <div class="form-grid">
                <x-admin::field name="contact_phone_href" label="Phone (dial link)" :value="$settings->contact_phone_href" placeholder="+85512345678" hint="Used for the tel: link." />
                <x-admin::field name="contact_location" label="Location" :value="$settings->contact_location" placeholder="Phnom Penh, Cambodia" />
            </div>
            <div class="form-grid">
                <x-admin::field name="contact_github_handle" label="GitHub handle" :value="$settings->contact_github_handle" placeholder="github.com/yourname" />
                <x-admin::field name="contact_github_href" label="GitHub URL" :value="$settings->contact_github_href" placeholder="https://github.com/yourname" />
            </div>
            <div class="form-grid">
                <x-admin::field name="contact_linkedin_handle" label="LinkedIn handle" :value="$settings->contact_linkedin_handle" placeholder="linkedin.com/in/yourname" />
                <x-admin::field name="contact_linkedin_href" label="LinkedIn URL" :value="$settings->contact_linkedin_href" placeholder="https://www.linkedin.com/in/yourname" />
            </div>
        </div>

        <div class="panel">
            <div class="panel__head">
                <h2 class="panel__title">Footer</h2>
            </div>

            <div class="form-grid">
                <x-admin::field name="footer_tagline" label="Footer tagline" :value="$settings->footer_tagline" />
                <x-admin::field name="footer_copyright" label="Copyright line" :value="$settings->footer_copyright" placeholder="© 2026 Kimlay. All rights reserved." />
            </div>
        </div>

        <x-admin::actions label="Save all settings" />
    </form>
@endsection
