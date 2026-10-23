@php($portfolio = $portfolio ?? config('portfolio'))
@php($contact = $portfolio['contact'])

<section id="contact" class="section contact">
    <div class="container contact__inner">
        <div class="contact__info">
            <span class="tag reveal">Contact</span>
            <h2 class="section-title reveal" style="--reveal-delay:.08s">{{ $contact['heading'] }}</h2>
            <p class="contact__desc reveal" style="--reveal-delay:.16s">{{ $contact['description'] }}</p>

            @php($items = [
                ['icon' => 'mail', 'label' => 'Email', 'value' => $contact['email'], 'href' => 'mailto:'.$contact['email']],
                ['icon' => 'phone', 'label' => 'Phone', 'value' => $contact['phone'], 'href' => 'tel:'.$contact['phone_href']],
                ['icon' => 'pin', 'label' => 'Location', 'value' => $contact['location'], 'href' => null],
                ['icon' => 'github', 'label' => 'GitHub', 'value' => preg_replace('#^https?://(www\.)?github\.com/#i', '@', $contact['github']['handle']), 'href' => $contact['github']['href']],
                ['icon' => 'linkedin', 'label' => 'LinkedIn', 'value' => preg_replace('#^https?://(www\.)?linkedin\.com/in/#i', '', $contact['linkedin']['handle']), 'href' => $contact['linkedin']['href']],
            ])

            <ul class="contact__list">
                @foreach ($items as $index => $item)
                    <li class="contact__item reveal" style="--reveal-delay: {{ 0.2 + $index * 0.06 }}s">
                        <span class="contact__item-icon" aria-hidden="true">
                            @include('partials.icons.icon', ['name' => $item['icon']])
                        </span>
                        <div class="contact__item-body">
                            <span class="contact__item-label">{{ $item['label'] }}</span>
                            @if ($item['href'])
                                <a href="{{ $item['href'] }}" @if(str_starts_with($item['href'], 'http')) target="_blank" rel="noopener noreferrer" @endif>{{ $item['value'] }}</a>
                            @else
                                <span>{{ $item['value'] }}</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <form class="contact__form reveal reveal--right" method="POST" action="{{ route('contact.store') }}" id="contactForm">
            @csrf

            <input type="text" name="website" class="hp-field" tabindex="-1" autocomplete="off" aria-hidden="true">

            @if (session('status'))
                <div class="alert" role="status">
                    @include('partials.icons.icon', ['name' => 'check'])
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <div class="form-row">
                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your name" required>
                    @error('name')<span class="field__error">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                    @error('email')<span class="field__error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="field">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="What is this about?" required>
                @error('subject')<span class="field__error">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" placeholder="Tell me about your project or idea..." required>{{ old('message') }}</textarea>
                @error('message')<span class="field__error">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="btn btn--primary btn--block" data-contact-submit>
                <span>Send Message</span>
                @include('partials.icons.icon', ['name' => 'send'])
            </button>
        </form>
    </div>
</section>
