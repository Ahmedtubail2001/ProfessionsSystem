<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\offerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RateController;
use App\Models\Offer;
use App\Models\Worker;

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

// middleware('auth:sanctum')->
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//about route
// 
Route::group(['middleware' => ['XSS', 'lang'], 'auth:sanctum'], function () {
    Route::apiResource('about', AboutController::class);

    Route::apiResource('/rate', RateController::class)->middleware('auth:sanctum');
    Route::apiResource('/gallery', GalleryController::class)->middleware('auth:sanctum');

    Route::get('/profileComment/{slug}', [WorkerController::class, 'profile_comment'])->middleware('auth:sanctum');
    Route::get('/profileGallery/{slug}', [WorkerController::class, 'profile_gallery'])->middleware('auth:sanctum');
    Route::post('/specific_offer/{slug}', [offerController::class, 'select_Offer'])->middleware(['auth:sanctum', 'checkIfOwnerProject']);
    // , 
    Route::get('/profile_work/{slug}', [WorkerController::class, 'profile_work'])->middleware(['auth:sanctum']);
    Route::get('/data_profile/{slug}', [WorkerController::class, 'data_profile'])->middleware(['auth:sanctum']);
    Route::post('update_cover_image/{slug}', [WorkerController::class, 'Edit_cover'])->middleware(['auth:sanctum', 'check_if_owner_profile:worker']);
    // , 'check_if_owner_profile:worker'
    Route::post('update_profile_image/{slug}', [WorkerController::class, 'Edit_image_profile'])->middleware(['auth:sanctum', 'check_if_owner_profile:worker']);
    Route::post('Edit_data_profile/{slug}', [WorkerController::class, 'Edit_data_profile'])->middleware(['auth:sanctum', 'check_if_owner_profile:worker']);


    Route::get('data_project', [ProjectController::class, 'dataProject'])->middleware('auth:sanctum');;
    Route::post('Filter', [ProjectController::class, 'filter'])->middleware('auth:sanctum');
    Route::get('offer/{slug}', [ProjectController::class, 'offer'])->middleware('auth:sanctum');
    // 
    Route::apiResource('projects', ProjectController::class)->middleware('auth:sanctum', 'checkOuthViewProject');;
    Route::post('offers/{offer}', [offerController::class, 'update'])->middleware(['auth:sanctum', 'AlowEditWithOffer']);
    // 
    Route::delete('offers/{offer}', [offerController::class, 'delete'])->middleware(['auth:sanctum', 'AlowEditWithOffer']);
    // 
    Route::apiResource('offers', offerController::class)->middleware(['auth:sanctum', 'checkOuthViewProject']);
    // 
    Route::get('/email/register', [WorkerController::class, 'sendEmailRegister'])->middleware(['auth:sanctum', 'checkIfAlreadyWorker'])->name('email.register');
    // 
    // Route::post('/forgin_password/check_email', [UserController::class, 'check_email'])->name('email.check');
    // Route::post('/forgin_password/reset_password', [UserController::class, 'reset_password'])->name('email.reset');


    Route::get('/user/delete/{id}', [UserController::class, 'destroy']);
    Route::get('/user/update/{id}', [UserController::class, 'update']);

    Route::Post('auth/register', [AccessTokensController::class, 'register']);
    //يجب أن يكون مضيف لعمل إضافة للبيانات
    Route::post('auth/access-tokens', [AccessTokensController::class, 'store'])->middleware('guest');
    Route::get('auth/logout/{token?}', [AccessTokensController::class, 'destroy'])->middleware(['auth:sanctum', 'guest']);

    Route::get('/worker', [WorkerController::class, 'index'])->middleware('auth:sanctum');
    Route::get('worker/show/{slug}', [WorkerController::class, 'show'])->middleware('auth:sanctum');
    Route::Post('worker/update/{slug}', [WorkerController::class, 'update'])->middleware('auth:sanctum');
    Route::post('worker/delete/{slug}', [WorkerController::class, 'destroy'])->middleware('auth:sanctum');
    Route::post('/worker', [WorkerController::class, 'store'])->middleware(['auth:sanctum', 'checkIfAlreadyWorker']);
    // 
    // Route::apiResource('worker', WorkerController::class)->middleware('auth:sanctum');
    Route::delete('/client/{slug}', [CustomerController::class, 'destroy'])->middleware(['auth:sanctum']);
    Route::post('/client', [CustomerController::class, 'store'])->middleware(['auth:sanctum']);
    Route::put('/client/{slug}', [CustomerController::class, 'update'])->middleware(['auth:sanctum']);
    Route::get('/client/data_profile/{slug}', [CustomerController::class, 'data_profile'])->middleware(['auth:sanctum']);

    // Route::post('/forgin_password', [CustomerController::class, 'data_profile'])->middleware(['auth:sanctum']);


});
