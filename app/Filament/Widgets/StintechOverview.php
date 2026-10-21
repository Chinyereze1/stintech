<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Testimonial;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StintechOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Published projects', Project::where('status', 'published')->count())
                ->description(Project::where('status', 'draft')->count() . ' in draft')
                ->icon('heroicon-o-rectangle-stack')
                ->color('primary'),

            Stat::make('Skills', Skill::count())
                ->description(Skill::where('show_on_home', true)->count() . ' shown on homepage')
                ->icon('heroicon-o-sparkles')
                ->color('gray'),

            Stat::make('Experience entries', Experience::count())
                ->description('Work & education timeline')
                ->icon('heroicon-o-briefcase')
                ->color('gray'),

            Stat::make('Testimonials', Testimonial::where('is_visible', true)->count())
                ->description(Testimonial::count() . ' total')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->color('gray'),
        ];
    }
}
