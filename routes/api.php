<?php

use App\Http\Middleware\LoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Discount\View\Controller\DiscountController;
use Src\Invoice\View\Controller\InvoiceController;
use Src\Product\View\Controller\ProductController;
use Src\Shopping\View\Controller\AddListController;
use Src\Shopping\View\Controller\BuyListController;
use Src\Shopping\View\Controller\DeleteListController;
use Src\Shopping\View\Controller\ShoppingListController;
use Src\SubCategory\View\Controller\SubCategoryController;
use Src\User\View\Controller\AuthController;
use Src\User\View\Controller\UserController;

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
Route::get('/discount', [DiscountController::class, 'show']);
Route::get('/discount/{uuid}', [DiscountController::class, 'find']);
Route::post('/discount', [DiscountController::class, 'create']);
Route::put('/discount/{uuid}', [DiscountController::class, 'update']);

Route::get('/subcategory', [SubCategoryController::class, 'index']);
Route::get('/subcategory/{uuid}', [SubCategoryController::class, 'find']);
Route::post('/subcategory', [SubCategoryController::class, 'create']);
Route::put('/subcategory/{uuid}', [SubCategoryController::class, 'update']);
Route::delete('/subcategory/{uuid}', [SubCategoryController::class, 'destroy']);

Route::get('shopping/list', [ShoppingListController::class, 'show']);
Route::post('/shopping/list', [AddListController::class, 'add']);
Route::delete('/shopping', [DeleteListController::class, 'subtractProduct']);
Route::delete('/shopping/list', [DeleteListController::class, 'deleteAllProduct']);
Route::delete('/shopping/all', [DeleteListController::class, 'deleteAllList']);

Route::get('/product/{uuidSubCategory}', [ProductController::class, 'indexBySubCategory']);
Route::get('/product/show/{uuid}', [ProductController::class, 'find']);
Route::post('/product', [ProductController::class, 'create']);
Route::put('/product/{uuid}', [ProductController::class, 'update']);
Route::delete('/product/{uuid}', [ProductController::class, 'destroy']);

Route::post('/user', [UserController::class, 'create']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware([LoggedIn::class])->group(function () 
{
    Route::get('/user', [UserController::class, 'find']);
    Route::put('/user', [UserController::class, 'update']);
    Route::post('/shopping/buy', [BuyListController::class, 'buy']);
    Route::get('/invoice', [InvoiceController::class, 'index']);
    Route::get('/shopping/{uuidInvoice}', [ShoppingListController::class, 'index']);
});
