@extends('layouts.app')

@section('content')
@include('partials.hero', ['title' => 'About Us', 'subtitle' => 'Our story, our work, and our approach.'])

<!-- About Stintech (left) / Skills (right) -->
<section class="max-w-6xl mx-auto px-8 sm:px-10 lg:px-16 py-20">
    <div class="grid md:grid-cols-2 gap-14 items-start">
        <div>
            <h2 class="text-2xl font-bold mb-4">About {{ $settings?->site_name ?? 'Stintech' }}</h2>
            {{--
                TODO (Austin): expand this if you'd like — keep it focused on
                Stintech as a studio rather than a personal bio.
            --}}
            <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-4">
                {{ $settings?->site_name ?? 'Stintech' }} is a web development studio focused on building fast,
                scalable websites and applications for individuals and small businesses. We believe good software
                should be reliable, easy to maintain, and genuinely pleasant to use — so that's exactly what we
                set out to build, project after project.
            </p>
            <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                From the first conversation to the final launch, we keep things straightforward: clear
                communication, honest timelines, and a finished product that's actually built to last.
            </p>

            @if($settings?->cv_file)
                <a href="{{ asset('storage/' . $settings->cv_file) }}" target="_blank"
                   class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-md font-bold hover:bg-blue-700 transition">
                    Download CV
                </a>
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-6">Skills</h2>
            <div class="flex flex-wrap gap-3">
                @forelse($skills as $skill)
                    <div class="flex items-center gap-2 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg px-4 py-2.5">
                        @if($skill->logo)
                            <img src="{{ asset('storage/' . $skill->logo) }}" class="w-5 h-5 object-contain">
                        @else
                            <i class="fa-solid fa-hashtag text-blue-600 text-xs"></i>
                        @endif
                        <span class="font-medium text-sm">{{ $skill->name }}</span>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm">No skills added yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Our Mission (left) / Our Process (right) -->
<section class="max-w-6xl mx-auto px-8 sm:px-10 lg:px-16 py-20 border-t border-slate-200 dark:border-slate-800">
    <div class="grid md:grid-cols-2 gap-14 items-start">
        <div>
            <h2 class="text-2xl font-bold mb-6">Our Mission</h2>
            <div class="border-l-4 border-blue-600 bg-slate-50 dark:bg-slate-900 rounded-lg p-6">
                <i class="fa-solid fa-quote-left text-blue-600 text-2xl mb-3"></i>
                <p class="text-lg text-slate-700 dark:text-slate-300 leading-relaxed italic">
                    To build software that just works — reliable, scalable, and genuinely enjoyable to use.
                    That's the standard we hold every project to, no matter how big or small.
                </p>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-6">Our Process</h2>
            <div class="space-y-5">
                <div class="flex gap-4">
                    <div class="w-8 h-8 shrink-0 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">1</div>
                    <div>
                        <h3 class="font-bold text-sm mb-1">Discover</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Understanding your goals and what "done well" looks like.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 shrink-0 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">2</div>
                    <div>
                        <h3 class="font-bold text-sm mb-1">Design</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">A clean, intuitive interface that fits your brand.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 shrink-0 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">3</div>
                    <div>
                        <h3 class="font-bold text-sm mb-1">Develop</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Built with modern, scalable, well-tested code.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="w-8 h-8 shrink-0 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">4</div>
                    <div>
                        <h3 class="font-bold text-sm mb-1">Deliver</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Launched, handed over clearly, and supported as you grow.</p>
                    </div>
                </div>
            </div>
        </div>

        {{--
            Experience timeline — hidden for now since the site is no longer
            framed around a personal bio. The data wiring (controller passes
            $experiences, model has date casts) is all still intact, so this
            can be uncommented any time to bring it back with zero extra work.

            <div>
                <h2 class="text-2xl font-bold mb-8">Experience</h2>
                <div class="space-y-6">
                    @forelse($experiences as $experience)
                        <div class="border-l-2 border-blue-600 pl-5">
                            <div class="text-xs text-slate-500">
                                {{ $experience->start_date->format('M Y') }} —
                                {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}
                            </div>
                            <h3 class="text-base font-bold">{{ $experience->position }}</h3>
                            <div class="text-blue-600 font-medium text-sm">{{ $experience->company }}</div>
                            @if($experience->description)
                                <p class="text-slate-600 dark:text-slate-400 text-sm mt-1.5">{{ $experience->description }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm">No experience entries yet — add some from austin-control.</p>
                    @endforelse
                </div>
            </div>
        --}}
    </div>
</section>

<!-- Testimonials -->
<section class="max-w-6xl mx-auto px-8 sm:px-10 lg:px-16 py-20 border-t border-slate-200 dark:border-slate-800">
    <h2 class="text-2xl font-bold mb-10 text-center">What Clients Say</h2>
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($testimonials as $testimonial)
            <div class="bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg p-6">
                <div class="text-amber-400 mb-3">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                </div>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-4">{{ $testimonial->feedback }}</p>
                <div class="flex items-center gap-3">
                    @if($testimonial->client_image)
                        <img src="{{ asset('storage/' . $testimonial->client_image) }}" class="w-9 h-9 rounded-full object-cover">
                    @endif
                    <div>
                        <div class="font-semibold text-sm">{{ $testimonial->client_name }}</div>
                        @if($testimonial->client_role || $testimonial->client_company)
                            <div class="text-slate-500 text-xs">{{ $testimonial->client_role }}{{ $testimonial->client_role && $testimonial->client_company ? ', ' : '' }}{{ $testimonial->client_company }}</div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-slate-500 text-sm col-span-2 text-center">No testimonials added yet — add some from austin-control.</p>
        @endforelse
    </div>
</section>
@endsection
