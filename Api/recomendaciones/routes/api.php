<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PerfilController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\AuthController;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);

Route::get('/categories', [CategoryController::class, 'list']);
Route::get('/categories/{id}', [CategoryController::class, 'getById']);
Route::post('/categories/create', [CategoryController::class, 'create']);
Route::post('/categories/update', [CategoryController::class, 'update']);


Route::get('/users', [UserController::class, 'list']);
Route::get('/users/{name}', [UserController::class, 'getUsers'])->where('name', '[a-zA-Z]+');
Route::get('/users/{id}', [UserController::class, 'getById'])->where('id', '\d+');
Route::post('/users/create', [UserController::class, 'create']);
Route::post('/users/update', [UserController::class, 'update']);

Route::get('/comments', [CommentController::class, 'list']);
Route::get('/comments/{id}', [CommentController::class, 'getById']);
Route::post('/comments/create', [CommentController::class, 'create']);
Route::post('/comments/update', [CommentController::class, 'update']);

Route::get('/places', [PlaceController::class, 'list']);
Route::get('/search/{category}', [PlaceController::class, 'searchByCategory'])->where('name', '[a-zA-Z]+');
Route::get('/places/{id}', [PlaceController::class, 'getById']);
Route::post('/places/create', [PlaceController::class, 'create']);
Route::post('/places/update', [PlaceController::class, 'update']);

Route::get('/ratings', [RatingController::class, 'list']);
Route::get('/ratings/{id}', [RatingController::class, 'getById']);
Route::post('/ratings/create', [RatingController::class, 'create']);
Route::post('/ratings/update', [RatingController::class, 'update']);

Route::get('/recommendations/{name}', [RecommendationController::class, 'getUserRecommendations'])->where('name', '[a-zA-Z]+');
Route::get('/recommendations/{user_id}', [RecommendationController::class, 'myrecommendations'])->where('id',  '\d+');
Route::get('/recommendations', [RecommendationController::class, 'list']);
Route::get('/recommendations/{id}', [RecommendationController::class, 'getById']);
Route::post('/recommendations/create', [RecommendationController::class, 'create']);
Route::post('/recommendations/update', [RecommendationController::class, 'update']);