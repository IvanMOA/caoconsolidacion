<?php

use App\Livewire\AttendeesFormPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/registro", AttendeesFormPage::class);
