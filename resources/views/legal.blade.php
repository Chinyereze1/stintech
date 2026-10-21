@extends('layouts.app')

@section('content')
@include('partials.hero', ['title' => $title])

<section class="max-w-3xl mx-auto px-8 sm:px-10 lg:px-16 py-20">
    @if($content)
        <div class="prose dark:prose-invert max-w-none">
            {!! $content !!}
        </div>
    @else
        <p class="text-slate-500 text-center">This page hasn't been filled in yet — add it from austin-control → Settings → Legal.</p>
    @endif
</section>
@endsection
