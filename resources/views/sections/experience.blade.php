@php($portfolio = $portfolio ?? config('portfolio'))

<section id="experience" class="section experience">
    <div class="container">
        <div class="section-head">
            <span class="tag reveal">My Journey</span>
            <h2 class="section-title reveal" style="--reveal-delay:.08s">Experience</h2>
            <p class="section-subtitle reveal" style="--reveal-delay:.16s">The path that shaped how I build software today.</p>
        </div>

        <div class="timeline">
            @foreach ($portfolio['experience'] as $item)
                <article class="timeline__item reveal {{ $loop->odd ? 'timeline__item--flip' : '' }}" style="--reveal-delay: {{ $loop->index * 0.12 }}s">
                    <span class="timeline__dot {{ $item['current'] ? 'timeline__dot--current' : '' }}" aria-hidden="true"></span>
                    <div class="timeline__content">
                        <span class="timeline__period">{{ $item['period'] }}</span>
                        <h3 class="timeline__title">{{ $item['title'] }}</h3>
                        <p class="timeline__desc">{{ $item['description'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
