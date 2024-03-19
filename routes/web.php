<?php

use App\Models\Gcash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GcashController;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::post('/submit', [GcashController::class, 'create']);
Route::get('/new', function()
{
    return view('new');
})->name('new');
Route::get('/view', function()
{
    return view('view', ['gcash' => Gcash::all()]);
});
Route::put('/edit/{id}', [GcashController::class, 'update']);