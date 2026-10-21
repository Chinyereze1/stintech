<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $guarded = []; // This allows all fields to be mass-assigned

    // Without these, Eloquent returns start_date/end_date as plain strings,
    // and calling ->format() on them (as the About page timeline does) fails.
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
