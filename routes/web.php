<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolarProductController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/products', function () {
    return view('pages.products');
})->name('products');

Route::get('/services', function () {
    return view('pages.services');
})->name('services');

Route::get('/gallery', function () {
    return view('pages.gallery');
})->name('gallery');

Route::get('/projects', function () {
    return view('pages.projects');
})->name('projects');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/solar-products', [SolarProductController::class, 'index'])->name('solar-products.index');
Route::get('/solar-products/{id}', [SolarProductController::class, 'show'])->name('solar-products.show');
