@extends('layouts.app')

@section('content')
@include('partials.hero', ['title' => 'Services', 'subtitle' => 'What I can help you build.'])

<section class="max-w-5xl mx-auto px-8 sm:px-10 lg:px-16 py-20">
    <div class="grid md:grid-cols-2 gap-6">
        @forelse($services as $service)
            <div class="p-6 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                @if($service->icon)
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center text-2xl text-blue-600 mb-4">{!! $service->icon !!}</div>
                @endif
                <h3 class="text-xl font-bold mb-2">{{ $service->title }}</h3>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">{{ $service->description }}</p>
            </div>
        @empty
            <div class="col-span-2 text-center py-12 border-2 border-dashed border-slate-200 dark:border-slate-800 rounded-lg">
                <p class="text-slate-500 text-sm">No services added yet — add some from austin-control.</p>
            </div>
        @endforelse
    </div>
</section>

@include('partials.cta')
@endsection
