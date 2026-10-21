<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Setting;
use App\Models\Experience;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Post;
use App\Models\ContactMessage;
use App\Mail\NewContactMessage;
use Illuminate\Support\Facades\Mail;

class PortfolioController extends Controller
{
    public function index()
    {
        try {
            $settings = Setting::first();
        } catch (\Throwable $e) {
            $settings = null;
        }

        try {
            $featuredProjects = Project::query()
                ->where('is_featured', true)
                ->where('status', 'published')
                ->take(3)
                ->get();
        } catch (\Throwable $e) {
            $featuredProjects = collect();
        }

        try {
            $skills = Skill::query()
                ->where('show_on_home', true)
                ->get();
        } catch (\Throwable $e) {
            $skills = collect();
        }

        try {
            $services = Service::where('is_active', true)
                ->orderBy('sort_order')
                ->get();
        } catch (\Throwable $e) {
            $services = collect();
        }

        return view('home', compact('settings', 'featuredProjects', 'skills', 'services'));
    }

    // Resume was folded into the About page — one page covering bio,
    // work/education timeline, skills, and the CV download.
    public function about()
    {
        $settings = Setting::first();
        $this->guardPage($settings, 'page_about');

        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $skills = Skill::orderBy('proficiency', 'desc')->get();
        $testimonials = Testimonial::where('is_visible', true)->get();
        return view('about', compact('settings', 'experiences', 'skills', 'testimonials'));
    }

    public function service()
    {
        $settings = Setting::first();
        $this->guardPage($settings, 'page_service');

        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('service', compact('settings', 'services'));
    }

    public function creativeStudio()
    {
        $settings = Setting::first();
        $this->guardPage($settings, 'page_project');

        // We get all published projects for now — once categories have
        // some real data in them, this can filter to non-web categories.
        $projects = Project::where('status', 'published')->get();
        return view('creative-studio', compact('settings', 'projects'));
    }

    public function showProject($slug)
    {
        $settings = Setting::first();
        $this->guardPage($settings, 'page_project');

        $project = Project::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('project-details', compact('project', 'settings'));
    }

    public function contact()
    {
        $settings = Setting::first();
        $this->guardPage($settings, 'page_contact');

        return view('contact', compact('settings'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $contactMessage = ContactMessage::create($validated);

        // If sending fails (e.g. shared hosting SMTP hiccup), the message is
        // still safely saved in the database — the visitor isn't blocked.
        try {
            $settings = Setting::first();
            if ($settings?->contact_email) {
                Mail::to($settings->contact_email)->send(new NewContactMessage($contactMessage));
            }
        } catch (\Throwable $e) {
            report($e);
        }

        return back()->with('success', 'Thanks for reaching out — I\'ll get back to you soon.');
    }

    public function blog()
    {
        $settings = Setting::first();

        if (! ($settings?->enable_blog ?? false)) {
            abort(404);
        }

        $posts = Post::where('status', 'published')
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('blog', compact('settings', 'posts'));
    }

    public function showPost($slug)
    {
        $settings = Setting::first();

        if (! ($settings?->enable_blog ?? false)) {
            abort(404);
        }

        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();

        return view('blog-details', compact('settings', 'post'));
    }

    public function privacyPolicy()
    {
        $settings = Setting::first();
        return view('legal', [
            'settings' => $settings,
            'title' => 'Privacy Policy',
            'content' => $settings?->privacy_policy,
        ]);
    }

    public function termsOfService()
    {
        $settings = Setting::first();
        return view('legal', [
            'settings' => $settings,
            'title' => 'Terms of Service',
            'content' => $settings?->terms_of_service,
        ]);
    }

    // Aborts with a 404 if the given page has been toggled off in
    // austin-control → Settings → Visibility.
    protected function guardPage(?Setting $settings, string $key): void
    {
        if ($settings && ! $settings->isVisible($key)) {
            throw new NotFoundHttpException();
        }
    }
}
