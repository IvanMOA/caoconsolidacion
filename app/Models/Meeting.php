<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    protected $fillable = ["starts_at"];
    public function attendees(): BelongsToMany
    {
        return $this->belongsToMany(Attendee::class);
    }
}
