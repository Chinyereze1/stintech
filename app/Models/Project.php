<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = []; // This allows all fields to be mass-assigned

    // 'tools' is stored as JSON in the database, but Filament's TagsInput
    // sends it as a PHP array. Without this cast, Eloquent tries to bind
    // the raw array straight into the query — which is what caused the
    // "Array to string conversion" error on save.
    protected $casts = [
        'tools' => 'array',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
