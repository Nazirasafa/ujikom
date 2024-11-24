<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\TextController;
use App\Http\Middleware\CheckSuperAdminRole;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('homepage');

Route::get('/news', [HomeController::class, 'news'])
    ->name('news');

Route::get('/news/{news}', [HomeController::class, 'showNews'])
->name('show.news');

Route::get('/events', [HomeController::class, 'events'])
    ->name('events');

Route::get('/events/{event}', [HomeController::class, 'showEvent'])
    ->name('show.event');

Route::get('/galleries', [HomeController::class, 'galleries'])
    ->name('galleries');

Route::get('/galleries/{gallery}', [HomeController::class, 'showGallery'])
    ->name('show.gallery');

Route::middleware([CheckSuperAdminRole::class])->group(function () {
    Route::prefix('dashboard')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->middleware(['auth', 'verified'])
            ->name('dashboard');

        Route::prefix('news')->group(function () {
            Route::get('/', [NewsController::class, 'index'])
                ->middleware(['auth'])
                ->name('dashboard.news');

            Route::get('/create', [NewsController::class, 'create'])
                ->middleware(['auth'])
                ->name('dashboard.news.create');

            Route::get('/{news}/edit', [NewsController::class, 'edit'])
                ->middleware(['auth'])
                ->name('dashboard.news.edit');

            Route::get('/{news}', [NewsController::class, 'show'])
                ->middleware(['auth'])
                ->name('dashboard.news.show');


            Route::put('/{news}', [NewsController::class, 'update'])
                ->middleware(['auth'])
                ->name('dashboard.news.update');

            Route::post('/', [NewsController::class, 'store'])
                ->middleware(['auth'])
                ->name('dashboard.news.store');

            Route::post('/{news}', [NewsController::class, 'storeCategory'])
                ->middleware(['auth'])
                ->name('dashboard.news.category.store');

            Route::delete('/{news}', [NewsController::class, 'destroy'])
                ->middleware(['auth'])
                ->name('dashboard.news.destroy');

            Route::delete('/{news}/{category}', [NewsController::class, 'destroyCategory'])
                ->middleware(['auth'])
                ->name('dashboard.news.category.destroy');

            Route::delete('/{news}/comment/{comment}', [NewsController::class, 'destroyComment'])
                ->middleware(['auth'])
                ->name('dashboard.news.comment.destroy');
        });


        Route::post('/get-categories', [CategoryController::class, 'getCategory'])
            ->middleware(['auth'])
            ->name('get-category');


        Route::prefix('events')->group(function () {
            Route::get('/', [EventController::class, 'index'])
                ->middleware(['auth'])
                ->name('dashboard.events');

            Route::get('/create', [EventController::class, 'create'])
                ->middleware(['auth'])
                ->name('dashboard.events.create');

            Route::get('/{event}/edit', [EventController::class, 'edit'])
                ->middleware(['auth'])
                ->name('dashboard.events.edit');

            Route::put('/{event}', [EventController::class, 'update'])
                ->middleware(['auth'])
                ->name('dashboard.events.update');

            Route::post('/', [EventController::class, 'store'])
                ->middleware(['auth'])
                ->name('dashboard.events.store');

            Route::delete('/{event}', [EventController::class, 'destroy'])
                ->middleware(['auth'])
                ->name('dashboard.events.destroy');
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])
                ->middleware(['auth'])
                ->name('dashboard.categories');

            Route::get('/create', [CategoryController::class, 'create'])
                ->middleware(['auth'])
                ->name('dashboard.categories.create');

            Route::get('/{category}/edit', [CategoryController::class, 'edit'])
                ->middleware(['auth'])
                ->name('dashboard.categories.edit');

            Route::put('/{category}', [CategoryController::class, 'update'])
                ->middleware(['auth'])
                ->name('dashboard.categories.update');

            Route::post('/', [CategoryController::class, 'store'])
                ->middleware(['auth'])
                ->name('dashboard.categories.store');

            Route::delete('/{category}', [CategoryController::class, 'destroy'])
                ->middleware(['auth'])
                ->name('dashboard.categories.destroy');
        });

        Route::prefix('homepage')->group(function () {
            Route::get('/', [DashboardController::class, 'editHome'])
                ->middleware(['auth'])
                ->name('dashboard.homepage');

            Route::put('/hero/{text}', [TextController::class, 'updateHero'])
                ->middleware(['auth'])
                ->name('hero.update');

            Route::put('/event/{text}', [TextController::class, 'updateEvent'])
                ->middleware(['auth'])
                ->name('event.update');

            Route::put('/news/{text}', [TextController::class, 'updateNews'])
                ->middleware(['auth'])
                ->name('news.update');

            Route::put('/gallery/{text}', [TextController::class, 'updateGallery'])
                ->middleware(['auth'])
                ->name('gallery.update');

            Route::put('/majors/{text}', [TextController::class, 'updateMajors'])
                ->middleware(['auth'])
                ->name('majors.update');

            Route::put('/stats/{stats}', [StatisticController::class, 'update'])
                ->middleware(['auth'])
                ->name('stats.update');

            Route::put('/major-detail/{major}', [MajorController::class, 'update'])
                ->middleware(['auth'])
                ->name('major-detail.update');
        });

        Route::prefix('galleries')->group(function () {
            Route::get('/', [GalleryController::class, 'index'])
                ->middleware(['auth'])
                ->name('dashboard.galleries');

            Route::get('/create', [GalleryController::class, 'create'])
                ->middleware(['auth'])
                ->name('dashboard.galleries.create');

            Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])
                ->middleware(['auth'])
                ->name('dashboard.galleries.edit');

            Route::get('/{gallery}', [GalleryController::class, 'show'])
                ->middleware(['auth'])
                ->name('dashboard.galleries.show');


            Route::put('/{gallery}', [GalleryController::class, 'update'])
                ->middleware(['auth'])
                ->name('dashboard.galleries.update');

            Route::post('/', [GalleryController::class, 'store'])
                ->middleware(['auth'])
                ->name('dashboard.galleries.store');

            Route::post('/{gallery}', [GalleryController::class, 'storeImage'])
                ->middleware(['auth'])
                ->name('dashboard.galleries.image.store');

            Route::delete('/{gallery}', [GalleryController::class, 'destroy'])
                ->middleware(['auth'])
                ->name('dashboard.galleries.destroy');

            Route::delete('/{image}/{gallery}', [GalleryController::class, 'destroyImage'])
                ->middleware(['auth'])
                ->name('dashboard.galleries.image.destroy');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
