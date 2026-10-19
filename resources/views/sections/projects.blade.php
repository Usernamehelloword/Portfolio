@php($portfolio = $portfolio ?? config('portfolio'))

<section id="projects" class="section projects">
    <div class="container">
        <div class="section-head">
            <span class="tag reveal">Portfolio</span>
            <h2 class="section-title reveal" style="--reveal-delay:.08s">Featured Work</h2>
            <p class="section-subtitle reveal" style="--reveal-delay:.16s">A selection of projects I've built and worked on.</p>
        </div>

        <div class="projects__list">
            @foreach ($portfolio['projects'] as $project)
                <article class="project-card reveal {{ $loop->odd ? 'project-card--flip' : '' }}">
                    <a class="project-card__media" href="{{ $project['demo'] }}" target="_blank" rel="noopener noreferrer" aria-label="Open live demo of {{ $project['name'] }}">
                        @if ($project['image'])
                            <img src="{{ asset($project['image']) }}" alt="{{ $project['name'] }} — project preview" width="800" height="560" loading="lazy">
                        @else
                            <span class="project-card__placeholder" aria-hidden="true">
                                @include('partials.icons.icon', ['name' => 'code'])
                            </span>
                        @endif
                    </a>

                    <div class="project-card__body">
                        <span class="project-card__index" aria-hidden="true">0{{ $loop->iteration }}</span>
                        <h3 class="project-card__title">{{ $project['name'] }}</h3>
                        <p class="project-card__desc">{{ $project['description'] }}</p>

                        <ul class="project-card__tags">
                            @foreach ($project['technologies'] as $tech)
                                <li>{{ $tech }}</li>
                            @endforeach
                        </ul>

                        <div class="project-card__links">
                            <a class="btn btn--ghost btn--sm" href="{{ $project['github'] }}" target="_blank" rel="noopener noreferrer">
                                @include('partials.icons.social', ['name' => 'github'])
                                GitHub
                            </a>
                            <a class="btn btn--primary btn--sm" href="{{ $project['demo'] }}" target="_blank" rel="noopener noreferrer">
                                Live Demo
                                @include('partials.icons.icon', ['name' => 'arrow-up-right'])
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
