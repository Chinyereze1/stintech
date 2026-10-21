@extends('layouts.app')

@section('content')
@include('partials.hero', ['title' => 'Get in Touch', 'subtitle' => 'Have a project in mind? Let\'s talk.'])

<section class="max-w-5xl mx-auto px-8 sm:px-10 lg:px-16 py-20">
    <div class="grid md:grid-cols-5 gap-8 bg-white dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">

        <!-- Info side -->
        <div class="md:col-span-2 bg-blue-600 text-white p-8 flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-bold mb-3">Let's build something.</h2>
                <p class="text-blue-100 text-sm leading-relaxed">
                    Send a message and I'll get back to you within a day or two.
                </p>
            </div>
            <div class="space-y-3 mt-10 text-sm">
                @if($settings?->contact_email)
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-envelope w-4"></i>
                        <a href="mailto:{{ $settings->contact_email }}" class="hover:underline">{{ $settings->contact_email }}</a>
                    </div>
                @endif
                @if($settings?->whatsapp_number)
                    <div class="flex items-center gap-3">
                        <i class="fa-brands fa-whatsapp w-4"></i>
                        <span>{{ $settings->whatsapp_number }}</span>
                    </div>
                @endif
                @if($settings?->github_url)
                    <div class="flex items-center gap-3">
                        <i class="fa-brands fa-github w-4"></i>
                        <a href="{{ $settings->github_url }}" target="_blank" class="hover:underline">GitHub</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Form side -->
        <div class="md:col-span-3 p-8">
            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}" class="space-y-5">
                @csrf

                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="relative">
                        <input type="text" name="name" id="name" placeholder=" " value="{{ old('name') }}"
                               class="peer w-full rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent px-4 pt-5 pb-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        <label for="name" class="absolute left-4 top-1.5 text-xs text-slate-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-focus:top-1.5 peer-focus:text-xs transition-all">Name</label>
                        @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="relative">
                        <input type="email" name="email" id="email" placeholder=" " value="{{ old('email') }}"
                               class="peer w-full rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent px-4 pt-5 pb-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        <label for="email" class="absolute left-4 top-1.5 text-xs text-slate-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-focus:top-1.5 peer-focus:text-xs transition-all">Email</label>
                        @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="relative">
                    <input type="text" name="subject" id="subject" placeholder=" " value="{{ old('subject') }}"
                           class="peer w-full rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent px-4 pt-5 pb-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                    <label for="subject" class="absolute left-4 top-1.5 text-xs text-slate-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-focus:top-1.5 peer-focus:text-xs transition-all">Subject</label>
                </div>

                <div class="relative">
                    <textarea name="message" id="message" rows="4" placeholder=" "
                              class="peer w-full rounded-lg border border-slate-300 dark:border-slate-700 bg-transparent px-4 pt-5 pb-2 text-sm focus:ring-2 focus:ring-blue-500 outline-none">{{ old('message') }}</textarea>
                    <label for="message" class="absolute left-4 top-1.5 text-xs text-slate-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-focus:top-1.5 peer-focus:text-xs transition-all">Message</label>
                    @error('message') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white px-8 py-3 rounded-md font-bold text-sm hover:bg-blue-700 transition">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
