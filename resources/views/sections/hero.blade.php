@php($portfolio = $portfolio ?? config('portfolio'))
@php($hero = $portfolio['hero'])

<section id="home" class="hero">
    <div class="hero__grid" aria-hidden="true"></div>

    <div class="container hero__inner">
        <div class="hero__content">
            <span class="hero__badge reveal">
                <span class="pulse-dot" aria-hidden="true"></span>
                {{ $portfolio['availability'] }}
            </span>

            <h1 class="hero__title reveal" style="--reveal-delay:.08s">
                {{ $hero['greeting'] }}<br>
                <span class="text-gradient">{{ $hero['name'] }}</span>
            </h1>

            <p class="hero__role reveal" style="--reveal-delay:.16s">{{ $portfolio['role'] }}</p>
            <p class="hero__desc reveal" style="--reveal-delay:.24s">{{ $portfolio['tagline'] }}</p>

            <div class="hero__actions reveal" style="--reveal-delay:.32s">
                <a href="#projects" class="btn btn--primary">
                    View My Work
                    @include('partials.icons.icon', ['name' => 'arrow-up-right'])
                </a>
                <a href="#contact" class="btn btn--ghost">Contact Me</a>
            </div>

            <div class="hero__socials reveal" style="--reveal-delay:.4s">
                @foreach (array_slice($portfolio['socials'], 0, 2) as $social)
                    <a href="{{ $social['href'] }}" target="_blank" rel="noopener noreferrer"
                       class="hero__social" aria-label="{{ $social['label'] }}" title="{{ $social['label'] }}">
                        @include('partials.icons.social', ['name' => $social['icon']])
                    </a>
                @endforeach
            </div>
        </div>

        <div class="hero__visual reveal reveal--zoom" style="--reveal-delay:.2s">
            <div class="hero__glow" aria-hidden="true"></div>
            <div class="hero__ring" aria-hidden="true"></div>
            <div class="hero__frame">
                <img src="{{ asset($hero['image']) }}" alt="Illustration of Kimlay, full-stack developer" width="520" height="520">
            </div>
            @foreach ($hero['chips'] as $index => $chip)
                <span class="hero__chip" style="--chip-delay: {{ $index * 0.7 }}s">{{ $chip }}</span>
            @endforeach
        </div>
    </div>

    <a href="#about" class="hero__scroll" aria-label="Scroll down to the about section">
        <span class="hero__scroll-line" aria-hidden="true"></span>
        @include('partials.icons.icon', ['name' => 'arrow-down'])
    </a>
</section>
