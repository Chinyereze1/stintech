@extends('layouts.app')

@section('content')
<section class="max-w-3xl mx-auto px-8 sm:px-10 lg:px-16 py-20">
    <a href="{{ route('blog') }}" class="text-blue-600 font-medium">&larr; Back to Blog</a>

    <div class="text-sm text-slate-500 mt-6">{{ $post->published_at?->format('F j, Y') }}</div>
    <h1 class="text-3xl md:text-4xl font-extrabold mt-2 mb-6 tracking-tight">{{ $post->title }}</h1>

    @if($post->excerpt)
        <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed mb-6">{{ $post->excerpt }}</p>
    @endif

    @if($post->featured_image)
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
             class="w-full rounded-lg mb-8">
    @endif

    <div class="prose dark:prose-invert max-w-none">
        {!! $post->content !!}
    </div>
</section>
@endsection
