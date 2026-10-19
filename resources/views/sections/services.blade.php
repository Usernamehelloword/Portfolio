@php($portfolio = $portfolio ?? config('portfolio'))

<section id="services" class="section services">
    <div class="container">
        <div class="section-head">
            <span class="tag reveal">Services</span>
            <h2 class="section-title reveal" style="--reveal-delay:.08s">What I Can Do</h2>
            <p class="section-subtitle reveal" style="--reveal-delay:.16s">
                Everything you need to take an idea from sketch to shipped product.
            </p>
        </div>

        <div class="services__grid">
            @foreach ($portfolio['services'] as $service)
                <article class="service-card reveal" style="--reveal-delay: {{ $loop->index * 0.08 }}s">
                    <span class="service-card__icon" aria-hidden="true">
                        @include('partials.icons.icon', ['name' => $service['icon']])
                    </span>
                    <h3 class="service-card__title">{{ $service['title'] }}</h3>
                    <p class="service-card__desc">{{ $service['description'] }}</p>
                    <span class="service-card__more" aria-hidden="true">0{{ $loop->iteration }}</span>
                </article>
            @endforeach
        </div>
    </div>
</section>
