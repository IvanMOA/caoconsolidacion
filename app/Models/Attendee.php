<?php

namespace App\Models;

use App\Filament\Resources\MeetingsResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attendee extends Model
{
    protected $fillable = ["name", "who_invited_me", "is_recurrent", "has_gone_to_another_church"];
    public function meetings(): BelongsToMany
    {
        return $this->belongsToMany(Meeting::class);
    }
}
