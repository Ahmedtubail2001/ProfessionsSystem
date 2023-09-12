<?php

use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\ImageController;
use App\Http\Controllers\admin\ProfessionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SpecialtiesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RolePermissionController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\UserPermissionController;
use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WorkerController;
use App\Models\Admin;
use App\Models\City;
use App\Models\Profession;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    $user = User::first();
    return view('cms.testPage')->with('user', $user);
});

Route::prefix('admin')->group(function () {
    //login
    Route::get('/login', [AdminController::class, 'showLogin'])->middleware('guest')->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->middleware('guest')->name('admin.checkLogin');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

Route::prefix('admin')
    ->middleware(['auth:admin', 'roleAdmin'])->group(function () {

        //main Page
        Route::get('/', function () {
            $users = User::count();
            $worker = Worker::count();
            $cities = City::count();
            $professions = Profession::count();
            $worker2 = Worker::withSum('rate', 'rate')->get();

            return view('cms.temp')->with([
                'users' => $users,
                'workers' => $worker,
                'cities' => $cities,
                'professions'  =>  $professions,
                'worker' => $worker2
            ]);
        })->name('admin.home');

        //specialities
        Route::get('/specialities/restore_index', [SpecialtiesController::class, 'index_restore'])->name('specialities.restore');
        Route::post('/specialities/restore/{id}', [SpecialtiesController::class, 'restore'])->name('specialities.restore_process');
        Route::resource('/specialities', SpecialtiesController::class);

        //professional
        Route::get('/professional/restore_index', [ProfessionController::class, 'index_restore'])->name('professional.restore');
        Route::post('/professional/restore/{id}', [ProfessionController::class, 'restore'])->name('professional.restore_process');
        Route::resource('/professional', ProfessionController::class);
        Route::resource('/cities', CityController::class);
        Route::resource('/images', ImageController::class);
        Route::resource('dashBoard/admins', AdminController::class);
        Route::post('/change_password', [AdminController::class, 'change_password'])->name('Admin.change_password');
        Route::get('/page_change_password', [AdminController::class, 'page_change_password'])->name('Admin.page_change_password');


        //Role and Permission
        Route::get('/role/delete/{id}', [RoleController::class, 'destroy']);
        Route::resource('/roles', RoleController::class);

        Route::get('/permission/delete/{id}', [PermissionController::class, 'destroy']);
        Route::resource('/permission', PermissionController::class);
        Route::resource('/users', UserController::class);

        Route::resource('user.permissions', UserPermissionController::class);
        Route::resource('role.permissions', RolePermissionController::class);
        Route::get(
            '/download',
            [ProjectController::class, 'download']
        )->name('download.file');
        Route::delete('/project/{slug}', [ProjectController::class, 'destroy_view'])->name('project.destroy');
        Route::get('/project', [ProjectController::class, 'index_view'])->name('project.index');

        Route::delete('/worker/{slug}', [WorkerController::class, 'destroy_view'])->name('worker.destroy');
        Route::get('/worker', [WorkerController::class, 'index_view'])->name('worker.index');
        // Route::resource('/project', ProjectController::class);

    });
Route::post('/forgin_password/check_email', [UserController::class, 'check_email'])->name('email.check');
Route::get('/forgin_password/page_change_password', [UserController::class, 'pageChangePassword'])->name('email.pageChange');
Route::post('/forgin_password/reset_password', [UserController::class, 'reset_password'])->name('user.Changepassword');

Route::get('password/check_email_page', function () {
    return view('cms.users.checkEmail');
});


        // Route::post('/forgin_password/reset_password', [UserController::class, 'reset_password'])->name('email.register');
