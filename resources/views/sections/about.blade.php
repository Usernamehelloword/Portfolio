@php($portfolio = $portfolio ?? config('portfolio'))
@php($about = $portfolio['about'])

<section id="about" class="section about">
    <div class="container about__inner">
        <div class="about__media reveal reveal--left">
            <div class="about__frame">
                <img src="{{ asset($about['image']) }}" alt="Code editor illustration representing Kimlay's workspace" width="640" height="520">
            </div>
            <div class="about__badge" aria-hidden="true">
                <strong>{{ $about['badge_value'] }}</strong>
                <span>{{ $about['badge_label'] }}</span>
            </div>
        </div>

        <div class="about__content">
            <span class="tag reveal">{{ $about['tag'] }}</span>
            <h2 class="section-title reveal" style="--reveal-delay:.08s">{{ $about['heading'] }}</h2>

            @foreach ($about['paragraphs'] as $paragraph)
                <p class="about__text reveal" style="--reveal-delay: {{ 0.16 + $loop->index * 0.08 }}s">{{ $paragraph }}</p>
            @endforeach

            <div class="about__stats">
                @foreach ($about['stats'] as $stat)
                    <div class="stat reveal" style="--reveal-delay: {{ 0.2 + $loop->index * 0.08 }}s">
                        <span class="stat__value" data-count="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">{{ $stat['value'] }}{{ $stat['suffix'] }}</span>
                        <span class="stat__label">{{ $stat['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
