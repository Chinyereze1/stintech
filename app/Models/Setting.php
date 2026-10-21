<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = []; // This allows all fields to be mass-assigned

    protected $casts = [
        'visibility' => 'array',
    ];

    // Every togglable section/page defaults to visible unless explicitly
    // turned off — so a fresh install or a key we add later never
    // accidentally hides something.
    public static function defaultVisibility(): array
    {
        return [
            'home_quick_stats' => true,
            'home_services' => true,
            'home_featured_projects' => true,
            'home_who_we_are' => true,
            'home_tech_stack' => true,
            'home_cta' => true,
            'page_service' => true,
            'page_project' => true,
            'page_about' => true,
            'page_contact' => true,
        ];
    }

    public function isVisible(string $key): bool
    {
        $visibility = $this->visibility ?? [];

        return (bool) ($visibility[$key] ?? true);
    }
}
