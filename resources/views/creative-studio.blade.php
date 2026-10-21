@extends('layouts.app')

@section('content')
@include('partials.hero', ['title' => 'Projects', 'subtitle' => 'A selection of recent work.'])

<section class="max-w-7xl mx-auto px-8 sm:px-10 lg:px-16 py-20">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($projects as $project)
            <a href="{{ route('project.show', $project->slug) }}"
               class="block rounded-lg overflow-hidden bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-blue-600 transition group">
                <div class="aspect-video bg-slate-200 dark:bg-slate-800 overflow-hidden">
                    @if($project->thumbnail)
                        <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition">
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-1">{{ $project->title }}</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">{{ $project->short_description }}</p>
                </div>
            </a>
        @empty
            <p class="text-slate-500 col-span-full text-center py-12">No projects published yet — add some from austin-control.</p>
        @endforelse
    </div>
</section>

@include('partials.cta')
@endsection
