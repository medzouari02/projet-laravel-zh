<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SCategorieController;
use App\Http\Controllers\CategorieController;
use App\Models\article;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Categorie Endpoints
/*
Route::get('/categories', [CategorieController::class, 'index']);
Route::post('/categories', [CategorieController::class, 'store']);
Route::get('/categories/{id}', [CategorieController::class, 'show']);
Route::put('/categories/{id}', [CategorieController::class, 'update']);
Route::delete('/categories/{id}', [CategorieController::class, 'destroy']);
*/

/* 
 * The code instructions below are meant replace all the above endpoints,
 * Its restriced to the main 5 methods(show, index, update, delete)
 */

 // Categories Endpoint
Route::middleware('api') -> group(function() {
    route::resource('categories', CategorieController::class); 
});

 // SCategories Endpoint
Route::middleware('api') -> group(function() {
    route::resource('Scategories', SCategorieController::class); 
});

 // Article Endpoint
Route::middleware('api') -> group(function() {
    route::resource('articles', ArticleController::class); 
});

// specific endpoint for Articles that executes the custom method showArticleByScat($idscat);
Route::get('/listarticles/{idscat}', [ArticleController::class, 'showArticleBySCAT']); 

// Pagination Endpoint
Route::get('/articles/art/articlespaginate', [ArticleController::class, 'articlesPaginate']); 