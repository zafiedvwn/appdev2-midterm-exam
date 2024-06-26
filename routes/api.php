<?php

use App\Http\Controllers\ProductController;
use App\Http\Middleware\ProductAccessMiddleware;
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

Route::apiResources([
    'products' => ProductController::class,
]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('extract.token')->group(function () {
    Route::get('/products', [ProductController::class,'index'])->withoutMiddleware([ProductAccessMiddleware::class]);

    Route::post('/createProduct', [ProductController::class,'store']);

    Route::post('/showProduct/{id}', [ProductController::class,'show']);

    Route::put('/updateProduct/{id}', [ProductController::class,'update']);

    Route::delete('/deleteProduct/{id}', [ProductController::class,'destroy']);


});

