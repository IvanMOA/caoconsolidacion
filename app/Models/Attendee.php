<?php

namespace App\Models;

use App\Filament\Resources\MeetingsResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Attendee extends Model
{
    protected $fillable = ["name", "who_invited_me", "is_recurrent","has_gone_to_another_church", "birth_day", "birth_month", "phone", "church_name", "is_interested_in_bible_study", "requests", "date_of_welcome"];
    public function meetings(): BelongsToMany
    {
        return $this->belongsToMany(Meeting::class);
    }

    public function tools(): BelongsToMany
    {
        return $this->belongsToMany(Tool::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            // $model->is_recurrent = false;
        });
    }
}
