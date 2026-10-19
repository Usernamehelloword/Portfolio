@php($portfolio = $portfolio ?? config('portfolio'))

<section id="skills" class="section skills">
    <div class="container">
        <div class="section-head">
            <span class="tag reveal">My Skills</span>
            <h2 class="section-title reveal" style="--reveal-delay:.08s">Technologies I work with</h2>
            <p class="section-subtitle reveal" style="--reveal-delay:.16s">
                A toolkit refined across real projects — from polished frontends to reliable backends.
            </p>
        </div>

        <div class="skills__grid">
            @foreach ($portfolio['skills'] as $group)
                <div class="skill-group reveal" style="--reveal-delay: {{ $loop->index * 0.08 }}s">
                    <div class="skill-group__head">
                        <span class="skill-group__icon" aria-hidden="true">
                            @include('partials.icons.icon', ['name' => $group['icon']])
                        </span>
                        <div class="skill-group__meta">
                            <h3>{{ $group['category'] }}</h3>
                            <p>{{ $group['blurb'] }}</p>
                        </div>
                    </div>

                    <ul class="skill-group__items">
                        @foreach ($group['items'] as $skill)
                            <li class="skill-card" style="--skill-color: {{ $skill['color'] }}; --level: {{ $skill['level'] }}%">
                                <span class="skill-card__badge" aria-hidden="true">{{ $skill['abbr'] }}</span>
                                <div class="skill-card__body">
                                    <div class="skill-card__row">
                                        <span class="skill-card__name">{{ $skill['name'] }}</span>
                                        <span class="skill-card__level">{{ $skill['level'] }}%</span>
                                    </div>
                                    <span class="skill-card__bar" aria-hidden="true">
                                        <span class="skill-card__fill"></span>
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
