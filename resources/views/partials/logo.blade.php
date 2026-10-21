{{--
    Usage: @include('partials.logo', ['class' => 'h-8'])
    Shows a square logo "mark" beside the site name, always together.
    If a logo image is uploaded, it's used inside the mark (swapping for
    light/dark mode if both are set). If not, the mark falls back to a
    colored box with the site name's first letter.
--}}
@php
    $siteName = $settings?->site_name ?? 'Stintech';
    $accent = $settings?->accent_color ?? '#2563eb';
@endphp

<div class="flex items-center gap-2.5">
    <div class="w-9 h-9 rounded-lg flex items-center justify-center overflow-hidden shrink-0" style="background: {{ $accent }}">
        @if($settings?->logo_light && $settings?->logo_dark)
            <img src="{{ asset('storage/' . $settings->logo_light) }}" alt="{{ $siteName }}" class="w-full h-full object-contain p-1 dark:hidden">
            <img src="{{ asset('storage/' . $settings->logo_dark) }}" alt="{{ $siteName }}" class="w-full h-full object-contain p-1 hidden dark:block">
        @elseif($settings?->logo_light || $settings?->logo_dark)
            <img src="{{ asset('storage/' . ($settings->logo_light ?? $settings->logo_dark)) }}" alt="{{ $siteName }}" class="w-full h-full object-contain p-1">
        @else
            <span class="font-bold text-xl text-white">{{ strtoupper(substr($siteName, 0, 1)) }}</span>
        @endif
    </div>
    <span class="text-xl font-bold tracking-tighter text-blue-600 uppercase">{{ $siteName }}</span>
</div>
