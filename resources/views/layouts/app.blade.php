<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $portfolio['meta_description'] ?? 'Kimlay — Full-Stack Developer & Creative Problem Solver building modern, responsive, high-performance web applications.' }}">
    <meta name="theme-color" content="#06080f">
    <meta name="author" content="{{ $portfolio['organization_name'] ?? 'Kimlay' }}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="{{ $portfolio['language'] ?? 'en' }}">
    <meta name="geo.region" content="KH">
    <meta name="geo.placename" content="{{ $portfolio['contact']['location'] ?? 'Phnom Penh, Cambodia' }}">
    @if(!empty($portfolio['geo_latitude']) && !empty($portfolio['geo_longitude']))
        <meta name="geo.position" content="{{ $portfolio['geo_latitude'] }};{{ $portfolio['geo_longitude'] }}">
        <meta name="ICBM" content="{{ $portfolio['geo_latitude'] }}, {{ $portfolio['geo_longitude'] }}">
    @endif
    <meta name="zipcode" content="12000">
    <meta name="city" content="Phnom Penh">
    <meta name="country" content="Cambodia">
    <link rel="canonical" href="{{ $portfolio['canonical_url'] ?? url()->current() }}">

    <title>{{ $portfolio['meta_title'] ?? 'Kimlay — Full-Stack Developer & Creative Problem Solver' }}</title>

    <meta property="og:type" content="{{ $portfolio['og_type'] ?? 'website' }}">
    <meta property="og:url" content="{{ $portfolio['canonical_url'] ?? url()->current() }}">
    <meta property="og:title" content="{{ $portfolio['meta_title'] ?? 'Kimlay — Full-Stack Developer & Creative Problem Solver' }}">
    <meta property="og:description" content="{{ $portfolio['meta_description'] ?? '' }}">
    <meta property="og:image" content="{{ asset($portfolio['og_image'] ?? 'images/hero-avatar.svg') }}">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta property="og:site_name" content="{{ $portfolio['organization_name'] ?? 'Kimlay' }}">

    <meta name="twitter:card" content="summary_large_image">
    @if(!empty($portfolio['twitter_handle']))
        <meta name="twitter:site" content="{{ $portfolio['twitter_handle'] }}">
        <meta name="twitter:creator" content="{{ $portfolio['twitter_handle'] }}">
    @endif
    <meta name="twitter:title" content="{{ $portfolio['meta_title'] ?? 'Kimlay — Full-Stack Developer & Creative Problem Solver' }}">
    <meta name="twitter:description" content="{{ $portfolio['meta_description'] ?? '' }}">
    <meta name="twitter:image" content="{{ asset($portfolio['og_image'] ?? 'images/hero-avatar.svg') }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>document.documentElement.classList.add('js');</script>

    @if(!empty($portfolio['organization_name']))
        <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "Person",
            "name": "{{ $portfolio['organization_name'] }}",
            "url": "{{ $portfolio['canonical_url'] ?? url('/') }}",
            "email": "{{ $portfolio['organization_email'] ?? ($portfolio['contact']['email'] ?? '') }}",
            "telephone": "{{ $portfolio['organization_phone'] ?? ($portfolio['contact']['phone'] ?? '') }}",
            "jobTitle": "{{ $portfolio['role'] ?? 'Full-Stack Developer' }}",
            "knowsAbout": @json(array_column($portfolio['skills'] ?? [], 'category')),
            "address": {
                "@@type": "PostalAddress",
                "addressLocality": "Phnom Penh",
                "addressCountry": "KH",
                "streetAddress": "{{ $portfolio['organization_address'] ?? ($portfolio['contact']['location'] ?? '') }}"
            },
            @if(!empty($portfolio['geo_latitude']) && !empty($portfolio['geo_longitude']))
            "geo": {
                "@@type": "GeoCoordinates",
                "latitude": {{ $portfolio['geo_latitude'] }},
                "longitude": {{ $portfolio['geo_longitude'] }}
            },
            @endif
            "sameAs": [
                @foreach($portfolio['socials'] ?? [] as $social)
                    "{{ $social['href'] }}"@if(!$loop->last),@endif
                @endforeach
            ],
            "contactPoint": {
                "@@type": "ContactPoint",
                "contactType": "customer service",
                "email": "{{ $portfolio['organization_email'] ?? ($portfolio['contact']['email'] ?? '') }}",
                "telephone": "{{ $portfolio['organization_phone'] ?? ($portfolio['contact']['phone'] ?? '') }}",
                "areaServed": "KH",
                "availableLanguage": ["{{ $portfolio['language'] ?? 'en' }}"]
            }
        }
        </script>
    @endif
</head>
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <button class="back-to-top" id="backToTop" type="button" aria-label="Back to top">
        @include('partials.icons.icon', ['name' => 'arrow-up'])
    </button>
</body>
</html>
