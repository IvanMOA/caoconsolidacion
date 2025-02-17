<?php

use App\Livewire\AttendeesFormPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get("/registro", AttendeesFormPage::class);
