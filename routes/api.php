<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\View\Controller\DiscountController;
use Src\View\Controller\ShoppingListController;
use Src\View\Controller\SubCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/discount', [DiscountController::class, 'show']);
Route::post('/discount', [DiscountController::class, 'create']);
Route::put('/discount/{uuid}', [DiscountController::class, 'update']);

Route::get('/subcategory', [SubCategoryController::class, 'index']);
Route::post('/subcategory', [SubCategoryController::class, 'create']);
Route::put('/subcategory/{uuid}', [SubCategoryController::class, 'update']);
Route::delete('/subcategory/{uuid}', [SubCategoryController::class, 'destroy']);

Route::post('/shopping/list', [ShoppingListController::class, 'add']);
Route::delete('/shopping/list', [ShoppingListController::class, 'subtractProduct']);
Route::delete('/shopping/all/product', [ShoppingListController::class, 'deleteAllProduct']);
Route::delete('/shopping/all/list', [ShoppingListController::class, 'deleteAllList']);