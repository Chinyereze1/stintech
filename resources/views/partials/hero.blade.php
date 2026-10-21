{{--
    Small page-header hero, used on pages that aren't the homepage
    (the homepage has its own distinct, larger hero).
    Usage: @include('partials.hero', ['title' => 'Projects', 'subtitle' => 'A selection of recent work.'])
--}}
<section class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/40">
    <div class="max-w-5xl mx-auto px-8 sm:px-10 lg:px-16 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">{{ $title }}</h1>
        @isset($subtitle)
            <p class="text-slate-500 mt-3">{{ $subtitle }}</p>
        @endisset
    </div>
</section>
