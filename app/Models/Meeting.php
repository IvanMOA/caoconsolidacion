<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    protected $fillable = ["name", "starts_at"];
    public function attendees(): HasMany
    {
        return $this->hasMany(AttendeeMeeting::class);
    }
}
