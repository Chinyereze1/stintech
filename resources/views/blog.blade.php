@extends('layouts.app')

@section('content')
@include('partials.hero', ['title' => 'Blog', 'subtitle' => 'Tech articles, updates, and notes.'])

<section class="max-w-6xl mx-auto px-8 sm:px-10 lg:px-16 py-20">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <a href="{{ route('blog.show', $post->slug) }}"
               class="block rounded-lg overflow-hidden bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 hover:border-blue-600 transition group">
                <div class="aspect-video bg-slate-200 dark:bg-slate-800 overflow-hidden">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition">
                    @endif
                </div>
                <div class="p-6">
                    <div class="text-xs text-slate-500 mb-2">{{ $post->published_at?->format('M j, Y') }}</div>
                    <h3 class="text-lg font-bold mb-2">{{ $post->title }}</h3>
                    @if($post->excerpt)
                        <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2">{{ $post->excerpt }}</p>
                    @endif
                </div>
            </a>
        @empty
            <p class="text-slate-500 col-span-full text-center py-12">No articles published yet — check back soon.</p>
        @endforelse
    </div>

    @if($posts->hasPages())
        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    @endif
</section>

@include('partials.cta')
@endsection
