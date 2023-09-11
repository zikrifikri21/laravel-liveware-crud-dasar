<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('tex');
});
Route::view('users','livewire.home');
