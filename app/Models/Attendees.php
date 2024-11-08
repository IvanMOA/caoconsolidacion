<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendees extends Model
{
    protected $fillable = ["name", "who_invited_me", "is_recurrent"];
}
