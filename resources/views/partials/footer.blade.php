@php($portfolio = $portfolio ?? config('portfolio'))

<footer class="footer">
    <div class="container footer__inner">
        <a href="#home" class="footer__logo">{{ $portfolio['logo'] }}</a>
        <p class="footer__tagline">{{ $portfolio['footer']['tagline'] }}</p>

        <div class="footer__socials">
            @foreach ($portfolio['socials'] as $social)
                <a href="{{ $social['href'] }}" target="_blank" rel="noopener noreferrer"
                   class="footer__social" aria-label="{{ $social['label'] }}" title="{{ $social['label'] }}">
                    @include('partials.icons.social', ['name' => $social['icon']])
                </a>
            @endforeach
        </div>

        <p class="footer__copy">{{ $portfolio['footer']['copyright'] }}</p>
    </div>
</footer>
