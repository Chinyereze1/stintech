<!DOCTYPE html>
<html lang="en"
      class="scroll-smooth"
      x-data="{ darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches), mobileOpen: false }"
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings?->site_name ?? 'Stintech' }}</title>
    @if($settings?->favicon)
        <link rel="icon" href="{{ asset('storage/' . $settings->favicon) }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Icon kits, so icons entered as <i> tags in the admin (and used across the site) render correctly -->
    <script src="https://kit.fontawesome.com/5b917c2ed3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="bg-white dark:bg-slate-950 text-slate-900 dark:text-white transition-colors duration-300">

    <!-- Navigation: back to the original simple full-width bar with plain links -->
    <nav class="fixed w-full z-50 top-0 bg-white/80 dark:bg-slate-950/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-8 sm:px-10 lg:px-16">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    @include('partials.logo', ['class' => 'h-8'])
                </a>

                <!-- Desktop nav: only shown from the laptop breakpoint (lg) up -->
                <div class="hidden lg:flex items-center space-x-8 font-medium text-sm">
                    <a href="{{ route('home') }}" class="hover:text-blue-500 transition">Home</a>
                    @if($settings?->isVisible('page_service') ?? true)
                        <a href="{{ route('service') }}" class="hover:text-blue-500 transition">Service</a>
                    @endif
                    @if($settings?->isVisible('page_project') ?? true)
                        <a href="{{ route('creative-studio') }}" class="hover:text-blue-500 transition">Project</a>
                    @endif
                    @if($settings?->isVisible('page_about') ?? true)
                        <a href="{{ route('about') }}" class="hover:text-blue-500 transition">About</a>
                    @endif
                    @if($settings?->enable_blog)
                        <a href="{{ route('blog') }}" class="hover:text-blue-500 transition">Blog</a>
                    @endif
                    @if($settings?->isVisible('page_contact') ?? true)
                        <a href="{{ route('contact') }}" class="hover:text-blue-500 transition">Contact</a>
                    @endif
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('contact') }}"
                       class="hidden sm:inline-block bg-blue-600 text-white px-5 py-2 rounded-md font-bold text-sm hover:bg-blue-700 transition">
                        Start a Project
                    </a>
                    <button @click="darkMode = !darkMode" class="w-10 h-10 flex items-center justify-center rounded-md bg-slate-100 dark:bg-slate-800 hover:ring-2 ring-blue-500 transition-all">
                        <i class="fa-solid fa-moon" x-show="!darkMode"></i>
                        <i class="fa-solid fa-sun" x-show="darkMode" x-cloak></i>
                    </button>

                    <!-- Hamburger: only shown below the laptop breakpoint (mobile + tablet) -->
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-md bg-slate-100 dark:bg-slate-800">
                        <i class="fa-solid fa-bars" x-show="!mobileOpen"></i>
                        <i class="fa-solid fa-xmark" x-show="mobileOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile/tablet dropdown menu -->
        <div x-show="mobileOpen" x-cloak
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="lg:hidden border-t border-slate-200 dark:border-slate-800 px-8 sm:px-10 py-4 space-y-1 bg-white dark:bg-slate-950">
            <a @click="mobileOpen = false" href="{{ route('home') }}" class="block px-3 py-2.5 rounded-md font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition">Home</a>
            @if($settings?->isVisible('page_service') ?? true)
                <a @click="mobileOpen = false" href="{{ route('service') }}" class="block px-3 py-2.5 rounded-md font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition">Service</a>
            @endif
            @if($settings?->isVisible('page_project') ?? true)
                <a @click="mobileOpen = false" href="{{ route('creative-studio') }}" class="block px-3 py-2.5 rounded-md font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition">Project</a>
            @endif
            @if($settings?->isVisible('page_about') ?? true)
                <a @click="mobileOpen = false" href="{{ route('about') }}" class="block px-3 py-2.5 rounded-md font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition">About</a>
            @endif
            @if($settings?->enable_blog)
                <a @click="mobileOpen = false" href="{{ route('blog') }}" class="block px-3 py-2.5 rounded-md font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition">Blog</a>
            @endif
            @if($settings?->isVisible('page_contact') ?? true)
                <a @click="mobileOpen = false" href="{{ route('contact') }}" class="block px-3 py-2.5 rounded-md font-medium hover:bg-slate-100 dark:hover:bg-slate-800 transition">Contact</a>
            @endif
            <a @click="mobileOpen = false" href="{{ route('contact') }}" class="block mt-2 text-center bg-blue-600 text-white px-3 py-2.5 rounded-md font-bold sm:hidden">Start a Project</a>
        </div>
    </nav>

    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/40">
        <div class="max-w-7xl mx-auto px-8 sm:px-10 lg:px-16 py-14 grid sm:grid-cols-2 md:grid-cols-3 gap-10">
            <div>
                <div class="mb-3">
                    @include('partials.logo', ['class' => 'h-7'])
                </div>
                <p class="text-sm text-slate-500 leading-relaxed mb-4">
                    Building scalable, modern web experiences — from clean code to thoughtful design.
                </p>

                <!-- Contact info and social links sit right under the writeup, uncategorized -->
                <div class="space-y-2 text-sm text-slate-500 mb-4">
                    @if($settings?->contact_email)
                        <div><a href="mailto:{{ $settings->contact_email }}" class="hover:text-blue-500 transition">{{ $settings->contact_email }}</a></div>
                    @endif
                    @if($settings?->whatsapp_number)
                        <div>{{ $settings->whatsapp_number }}</div>
                    @endif
                </div>

                <div class="flex items-center gap-3">
                    @if($settings?->github_url)
                        <a href="{{ $settings->github_url }}" target="_blank"
                           class="w-9 h-9 flex items-center justify-center rounded-md bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 hover:text-blue-500 hover:border-blue-500 transition">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    @endif
                    @if($settings?->linkedin_url)
                        <a href="{{ $settings->linkedin_url }}" target="_blank"
                           class="w-9 h-9 flex items-center justify-center rounded-md bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 hover:text-blue-500 hover:border-blue-500 transition">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <div class="text-sm font-semibold uppercase tracking-wide text-slate-400 mb-3">Company</div>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-500 transition">Home</a></li>
                    @if($settings?->isVisible('page_project') ?? true)
                        <li><a href="{{ route('creative-studio') }}" class="hover:text-blue-500 transition">Project</a></li>
                    @endif
                    @if($settings?->isVisible('page_about') ?? true)
                        <li><a href="{{ route('about') }}" class="hover:text-blue-500 transition">About</a></li>
                    @endif
                    @if($settings?->enable_blog)
                        <li><a href="{{ route('blog') }}" class="hover:text-blue-500 transition">Blog</a></li>
                    @endif
                    @if($settings?->isVisible('page_contact') ?? true)
                        <li><a href="{{ route('contact') }}" class="hover:text-blue-500 transition">Contact</a></li>
                    @endif
                </ul>
            </div>

            <div>
                <div class="text-sm font-semibold uppercase tracking-wide text-slate-400 mb-3">Services</div>
                <ul class="space-y-2 text-sm">
                    @forelse($footerServices as $service)
                        <li><a href="{{ route('service') }}" class="hover:text-blue-500 transition">{{ $service->title }}</a></li>
                    @empty
                        <li><a href="{{ route('service') }}" class="hover:text-blue-500 transition">View Services</a></li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Rights reserved (left) / Legal links (right) -->
        <div class="border-t border-slate-200 dark:border-slate-800 py-5">
            <div class="max-w-7xl mx-auto px-8 sm:px-10 lg:px-16 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-slate-400">
                <div>&copy; {{ date('Y') }} {{ $settings?->site_name ?? 'Stintech' }}. All rights reserved.</div>
                <div class="flex gap-5">
                    <a href="{{ route('privacy-policy') }}" class="hover:text-blue-500 transition">Privacy Policy</a>
                    <a href="{{ route('terms-of-service') }}" class="hover:text-blue-500 transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.waves.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    VANTA.WAVES({
        el: "#vanta-canvas",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        // These colors match your screenshot (Light Blue/Steel)
        color: 0x3b82f6, 
        backgroundColor: 0xdae9ff, 
        shininess: 35.00,
        waveHeight: 20.00,
        waveSpeed: 0.80,
        zoom: 0.90
    })
})
</script>

<script>
let vantaEffect;

function initVanta() {
    const isDark = document.documentElement.classList.contains('dark');
    
    if (vantaEffect) vantaEffect.destroy();

    vantaEffect = VANTA.WAVES({
        el: "#vanta-canvas",
        mouseControls: true,
        touchControls: true,
        scale: 1.00,
        scaleMobile: 1.00,
        // Adjust colors based on theme
        color: isDark ? 0x1e40af : 0x3b82f6,
        backgroundColor: isDark ? 0x020617 : 0xdae9ff,
        waveHeight: 15.00,
        waveSpeed: 0.60
    });
}

// Initialize on load
document.addEventListener('DOMContentLoaded', initVanta);

// Re-initialize if the user toggles dark mode
// Note: This assumes you are using a button that adds/removes 'dark' class
const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        if (mutation.attributeName === 'class') {
            initVanta();
        }
    });
});
observer.observe(document.documentElement, { attributes: true });
</script> -->

</body>
</html>
