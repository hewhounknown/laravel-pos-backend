<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('category/create', [CategoryController::class, 'createCategory']);
Route::get('category/find/{id}', [CategoryController::class, 'findCategory']);
Route::get('category/get', [CategoryController::class, 'getCategories']);
Route::put('category/update/{id}', [CategoryController::class, 'updateCategory']);
Route::delete('category/delete/{id}', [CategoryController::class, 'deleteCategory']);

