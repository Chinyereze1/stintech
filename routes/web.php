<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::get('/', [PortfolioController::class, 'index'])->name('home');

Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/service', [PortfolioController::class, 'service'])->name('service');
Route::get('/projects', [PortfolioController::class, 'creativeStudio'])->name('creative-studio');
Route::get('/projects/{slug}', [PortfolioController::class, 'showProject'])->name('project.show');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');
Route::post('/contact', [PortfolioController::class, 'submitContact'])->name('contact.submit');
Route::get('/blog', [PortfolioController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [PortfolioController::class, 'showPost'])->name('blog.show');
Route::get('/privacy-policy', [PortfolioController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-of-service', [PortfolioController::class, 'termsOfService'])->name('terms-of-service');
