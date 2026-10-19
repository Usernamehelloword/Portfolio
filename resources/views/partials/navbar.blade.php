@php($portfolio = $portfolio ?? config('portfolio'))

<header class="navbar" id="navbar">
    <div class="container navbar__inner">
        <a href="#home" class="navbar__logo">{{ $portfolio['logo'] }}</a>

        <nav class="navbar__links" id="navLinks" aria-label="Primary navigation">
            @foreach ($portfolio['nav'] as $item)
                <a href="{{ $item['href'] }}" class="navbar__link" data-nav-link>{{ $item['label'] }}</a>
            @endforeach
            <a href="#contact" class="btn btn--primary btn--sm navbar__cta" data-nav-link>Let's Talk</a>
        </nav>

        <button class="navbar__toggle" id="navToggle" type="button" aria-expanded="false" aria-controls="navLinks" aria-label="Toggle navigation menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
