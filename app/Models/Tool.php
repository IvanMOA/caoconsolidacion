<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tool extends Model
{
    protected $fillable = ["name"];
    public function attendees(): BelongsToMany
    {
        return $this->belongsToMany(Attendee::class);
    }
}
