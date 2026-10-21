{{--
    CTA band, shown right before the footer on Home, Service, and Project pages.
    Usage: @include('partials.cta')
--}}
<section class="max-w-7xl mx-auto px-8 sm:px-10 lg:px-16 py-16">
    <div class="bg-blue-600 rounded-lg px-8 py-12 text-center text-white">
        <h2 class="text-2xl md:text-3xl font-bold mb-3">Got a project in mind?</h2>
        <p class="text-blue-100 mb-6 max-w-xl mx-auto">
            Let's talk about how we can bring it to life — clean, scalable, and built to last.
        </p>
        <a href="{{ route('contact') }}"
           class="inline-block bg-white text-blue-600 px-8 py-3 rounded-md font-bold hover:bg-blue-50 transition">
            Start a Conversation
        </a>
    </div>
</section>
