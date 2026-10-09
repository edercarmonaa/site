<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/courses', [PageController::class, 'courses'])->name('courses');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::get('/_limited', fn () => 'ok')->middleware('throttle:technical')->name('technical.limited');

if (app()->environment('testing')) {
    Route::match(['GET', 'POST'], '/_error/{status}', fn (int $status) => abort($status))
        ->whereNumber('status');
    Route::post('/_method-only', fn () => 'ok');
}
