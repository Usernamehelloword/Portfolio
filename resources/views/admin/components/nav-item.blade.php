@props([
    'href',
    'pattern' => null,
])

@php($patterns = filled($pattern) ? explode('|', (string) $pattern) : [])

<a
    href="{{ $href }}"
    {{ $attributes->class(['admin-nav__link', 'is-active' => filled($patterns) && request()->routeIs($patterns)]) }}
>
    {{ $slot }}
</a>
