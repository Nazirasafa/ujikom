<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\GalleryController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\TokenController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
         
Route::middleware('auth:sanctum')->group( function () {
    Route::resources([
        'categories' => CategoryController::class,
        'posts' => PostController::class,
        'galleries' => GalleryController::class,
        'events' => EventController::class,
    ]);
    Route::get('check-token', [TokenController::class, 'index'])->name('tokens.index');

    Route::put('profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    Route::post('posts/{post}/comment', [PostController::class, 'addComment'])->name('posts.addComment');
    Route::post('posts/{post}/like', [PostController::class, 'likePost'])->name('posts.likePost');
    Route::delete('posts/{post}/unlike', [PostController::class, 'unlikePost'])->name('posts.unlikePost');
    

    Route::delete('comment/{comment}/delete', [PostController::class, 'deleteComment'])->name('posts.deleteComment');
    
    Route::post('posts/{post}/images', [PostController::class, 'addImage'])->name('posts.addImage');
    Route::delete('image/{image}/delete', [PostController::class, 'deleteImage'])->name('posts.deleteImage');
    
    Route::post('galleries/{gallery}/images', [GalleryController::class, 'addImage'])->name('gallery.addImage');
    Route::delete('galleries/{image}/delete', [GalleryController::class, 'deleteImage'])->name('gallery.deleteImage');
}); 


Route::get('latest/posts', [PostController::class, 'latestPosts'])->name('posts.latestPosts');
Route::get('latest/events', [EventController::class, 'latestEvents'])->name('events.latestEvents');

Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
