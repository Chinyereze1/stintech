@extends('layouts.app')

@section('content')
<section class="max-w-4xl mx-auto px-8 sm:px-10 lg:px-16 py-20">
    <a href="{{ route('creative-studio') }}" class="text-blue-600 font-medium">&larr; Back to Projects</a>

    <h1 class="text-4xl md:text-5xl font-extrabold mt-6 mb-4 tracking-tight">{{ $project->title }}</h1>

    @if($project->thumbnail)
        <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}"
             class="w-full rounded-lg mb-8">
    @endif

    @if($project->tools)
        <div class="flex flex-wrap gap-2 mb-8">
            @foreach($project->tools as $tool)
                <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-sm font-medium">{{ $tool }}</span>
            @endforeach
        </div>
    @endif

    <div class="prose dark:prose-invert max-w-none mb-8">
        {!! $project->layout_type === 'case_study' ? $project->content : nl2br(e($project->short_description)) !!}
    </div>

    <div class="flex gap-4">
        @if($project->live_url)
            <a href="{{ $project->live_url }}" target="_blank"
               class="bg-blue-600 text-white px-6 py-3 rounded-md font-bold hover:bg-blue-700 transition">Live Site</a>
        @endif
        @if($project->github_url)
            <a href="{{ $project->github_url }}" target="_blank"
               class="border border-slate-300 dark:border-slate-700 px-6 py-3 rounded-md font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition">GitHub</a>
        @endif
    </div>
</section>
@endsection
