@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden">

    <!-- MAIN CONTENT -->
    <div class="relative z-10 max-w-7xl mx-auto px-8 sm:px-10 lg:px-16 pt-16 pb-16 w-full">
        <div class="grid lg:grid-cols-[2fr_3fr] gap-10 items-end">

            <!-- Left Side: Text -->
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold mb-6 tracking-tight leading-[1.05] text-slate-900 dark:text-white">
                    Building Digital <span class="text-blue-600">Masterpieces.</span>
                </h1>
                <p class="text-base md:text-lg text-slate-600 dark:text-slate-400 max-w-xl mb-8">
                    <span class="font-bold text-slate-900 dark:text-white">{{ $settings?->site_name ?? 'Stintech' }}</span>
                    designs and builds scalable, modern web experiences for individuals and businesses.
                </p>
                <div class="flex gap-4">
                    <a href="#projects" class="bg-blue-600 text-white px-6 py-3 text-sm rounded-md font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/30">View My Work</a>
                    <a href="{{ route('contact') }}" class="border border-slate-300 dark:border-slate-700 px-6 py-3 text-sm rounded-md font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition">Start a Project</a>
                </div>
            </div>

            <!-- Right Side: your laptop image (already includes its own base/glow) with a supporting ambient panel behind it -->
            <div class="hidden lg:flex relative justify-center h-[400px]">
                <!-- Supporting ambient panel/backdrop for the whole visual -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[560px] h-[560px] bg-blue-600/20 blur-[130px] rounded-full"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[380px] h-[380px] bg-blue-500/10 blur-[90px] rounded-full"></div>

                <picture class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full">
                    <source srcset="{{ asset('images/laptop-hero.webp') }}" type="image/webp">
                    <img src="{{ asset('images/laptop-hero.png') }}"
                         alt="{{ $settings?->site_name ?? 'Stintech' }} homepage on a laptop"
                         class="relative z-20 w-full max-w-none object-contain"
                         style="filter: drop-shadow(0 20px 20px rgba(15, 23, 42, 0.2));  margin-bottom: -40px;">
                </picture>
            </div>

        </div>
    </div>
</section>

@if($settings?->isVisible('home_quick_stats') ?? true)
<!-- Quick Stats, with count-up animation on scroll into view -->
<section class="max-w-7xl mx-auto px-8 sm:px-10 lg:px-16 pb-16">
    <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg px-8 py-7 grid grid-cols-2 md:grid-cols-4 divide-x divide-slate-200 dark:divide-slate-800">

        <div class="text-center px-2"
             x-data="{ count: 0 }"
             x-init="
                let obs = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        let target = 10, start = 0, step = 1;
                        let timer = setInterval(() => {
                            start += step;
                            count = start;
                            if (start >= target) clearInterval(timer);
                        }, 60);
                        obs.disconnect();
                    }
                }, { threshold: 0.4 });
                obs.observe($el);
             ">
            <i class="fa-solid fa-diagram-project text-2xl mb-2 text-blue-600"></i>
            <div class="text-3xl font-bold text-slate-900 dark:text-white"><span x-text="count"></span>+</div>
            <div class="text-slate-500 text-sm">Projects Completed</div>
        </div>

        <div class="text-center px-2"
             x-data="{ count: 0 }"
             x-init="
                let obs = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        let target = 5, start = 0, step = 1;
                        let timer = setInterval(() => {
                            start += step;
                            count = start;
                            if (start >= target) clearInterval(timer);
                        }, 120);
                        obs.disconnect();
                    }
                }, { threshold: 0.4 });
                obs.observe($el);
             ">
            <i class="fa-regular fa-face-smile text-2xl mb-2 text-blue-600"></i>
            <div class="text-3xl font-bold text-slate-900 dark:text-white"><span x-text="count"></span>+</div>
            <div class="text-slate-500 text-sm">Happy Clients</div>
        </div>

        <div class="text-center px-2"
             x-data="{ count: 0 }"
             x-init="
                let obs = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        let target = 100, start = 0, step = 4;
                        let timer = setInterval(() => {
                            start += step;
                            count = Math.min(start, target);
                            if (start >= target) clearInterval(timer);
                        }, 20);
                        obs.disconnect();
                    }
                }, { threshold: 0.4 });
                obs.observe($el);
             ">
            <i class="fa-solid fa-bullseye text-2xl mb-2 text-blue-600"></i>
            <div class="text-3xl font-bold text-slate-900 dark:text-white"><span x-text="count"></span>%</div>
            <div class="text-slate-500 text-sm">Delivery Rate</div>
        </div>

        <div class="text-center px-2">
            <i class="fa-solid fa-headset text-2xl mb-2 text-blue-600"></i>
            <div class="text-3xl font-bold text-slate-900 dark:text-white">24/7</div>
            <div class="text-slate-500 text-sm">Support</div>
        </div>
    </div>
</section>
@endif

@if($settings?->isVisible('home_services') ?? true)
<!-- Services Overview (dynamic) -->
<section class="max-w-7xl mx-auto px-8 sm:px-10 lg:px-16 py-20 border-t border-slate-200 dark:border-slate-800">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold mb-2">Our Services</h2>
        <p class="text-slate-500">Tailored digital solutions for your brand.</p>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($services as $service)
            <div class="p-6 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-blue-500 transition shadow-sm">
                @if($service->icon)
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-2xl text-blue-600 mb-4">{!! $service->icon !!}</div>
                @endif
                <h3 class="text-lg font-bold mb-2">{{ $service->title }}</h3>
                <p class="text-slate-500 text-sm">{{ $service->description }}</p>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-lg">
                <p class="text-slate-500 text-sm">No services added yet — add some from austin-control.</p>
            </div>
        @endforelse
    </div>
</section>
@endif

@if($settings?->isVisible('home_featured_projects') ?? true)
<!-- Featured Projects -->
<section id="projects" class="max-w-7xl mx-auto px-8 sm:px-10 lg:px-16 py-20 bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800">
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-bold mb-1">Featured Work</h2>
            <p class="text-slate-500">A selection of recent projects.</p>
        </div>
        <a href="{{ route('creative-studio') }}" class="text-blue-600 font-bold hover:underline">View All →</a>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        @forelse($featuredProjects as $project)
            <a href="{{ route('project.show', $project->slug) }}" class="group block bg-slate-50 dark:bg-slate-900 rounded-lg overflow-hidden border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="overflow-hidden aspect-video">
                    <img src="{{ asset('storage/' . $project->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <div class="flex gap-2 mb-3 flex-wrap">
                        @foreach($project->tools ?? [] as $tool)
                            <span class="text-xs uppercase tracking-widest bg-slate-200 dark:bg-slate-800 px-2 py-1 rounded">{{ $tool }}</span>
                        @endforeach
                    </div>
                    <h3 class="text-lg font-bold mb-1">{{ $project->title }}</h3>
                    <span class="text-blue-600 font-semibold inline-flex items-center group-hover:gap-2 gap-1 transition-all">View Case Study →</span>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center py-12 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-lg">
                <p class="text-slate-500 text-sm">No featured projects yet. Add them in the admin!</p>
            </div>
        @endforelse
    </div>
</section>
@endif

@if($settings?->isVisible('home_who_we_are') ?? true)
<!-- Who We Are (left) / Why Choose Us (right) -->
<section class="max-w-7xl mx-auto px-8 sm:px-10 lg:px-16 py-20 border-slate-200 dark:border-slate-800">
    <div class="grid md:grid-cols-2 gap-14 items-start">
        <div>
            <h2 class="text-3xl font-bold mb-4">Who We Are</h2>
            <div class="text-slate-600 dark:text-slate-400 leading-relaxed space-y-4">
                <p>
                    {{ $settings?->site_name ?? 'Stintech' }} is a web development studio built around a simple
                    idea: great software shouldn't be complicated to work with. We design and build fast, scalable
                    websites and web applications for individuals, startups, and small businesses who want
                    something that actually works — not just something that looks good on day one.
                </p>
                <p>
                    Every project starts with a conversation about what you actually need, not a generic template.
                    From there, we keep our stack modern, our code clean, and our communication honest — because
                    that's what makes a project (and a working relationship) go smoothly from first call to launch
                    day and beyond.
                </p>
                <p>
                    Whether you're a solo founder needing your first website or a growing business that's
                    outgrown its old one, {{ $settings?->site_name ?? 'Stintech' }} builds it to last.
                </p>
            </div>
            <a href="{{ route('about') }}" class="inline-block mt-6 text-blue-600 font-semibold hover:underline">More about us →</a>
        </div>

        <div>
            <h2 class="text-3xl font-bold mb-6">Why Choose Us</h2>
            <div class="space-y-5">
                <div class="flex gap-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg p-5 shadow-sm">
                    <div class="w-11 h-11 shrink-0 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-blue-600 text-lg">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Fast, Reliable Delivery</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">We respect deadlines and keep you updated every step of the way, so your project launches on time — every time.</p>
                    </div>
                </div>
                <div class="flex gap-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg p-5 shadow-sm">
                    <div class="w-11 h-11 shrink-0 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-blue-600 text-lg">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Clean, Scalable Code</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Every line is written to grow with your business, so future updates stay simple instead of turning into rewrites.</p>
                    </div>
                </div>
                <div class="flex gap-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg p-5 shadow-sm">
                    <div class="w-11 h-11 shrink-0 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-blue-600 text-lg">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Secure By Default</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Security isn't an afterthought — it's built into every project from day one, to keep your data and your users safe.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if($settings?->isVisible('home_tech_stack') ?? true)
<!-- Tech Stack -->
<section class="max-w-7xl mx-auto px-8 sm:px-10 lg:px-16 py-20 border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900">
    <h2 class="text-2xl font-bold mb-10 text-center">Our Tech Stack</h2>
    <div class="flex flex-wrap justify-center gap-4">
        @forelse($skills as $skill)
            <div class="bg-white dark:bg-slate-900 px-5 py-2.5 rounded-lg border border-slate-200 dark:border-slate-800 flex items-center gap-2.5 shadow-sm">
                @if($skill->logo)
                    <img src="{{ asset('storage/' . $skill->logo) }}" class="w-5 h-5 object-contain">
                @else
                    <i class="fa-solid fa-hashtag text-blue-600 text-xs"></i>
                @endif
                <span class="font-medium">{{ $skill->name }}</span>
            </div>
        @empty
            <p class="text-slate-500 text-sm">No skills marked "Show on homepage" yet.</p>
        @endforelse
    </div>
</section>
@endif

@if($settings?->isVisible('home_cta') ?? true)
    @include('partials.cta')
@endif
@endsection