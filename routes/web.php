<?php
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::resource('notes', NoteController::class);

Route::get('/', function () {
    return view('welcome'); 
});
