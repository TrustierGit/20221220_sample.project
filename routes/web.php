<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthenticatedSessionController;
use Carbon\Carbon;


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
    return redirect('/login',);
});


Route::get('/dashboard','App\Http\Controllers\NotificationController@index')->middleware(['auth'])->name('dashboard');


Route::prefix('user')->middleware(['auth'])->middleware('can:user')->group(function(){

    Route::get('/reservation_list','App\Http\Controllers\ReservationController@show')->name('reservation');
    Route::post('/reservation_list','App\Http\Controllers\ReservationController@switch')->name('switch');
    Route::get('/download_link','App\Http\Controllers\ReservationController@download_link')->name('download_link');

    Route::get('/ajax/',[ReservationController::class,'ajax']);
});

Route::prefix('admin')->middleware(['auth'])->middleware('can:admin')->group(function(){
    Route::get('/download', 'App\Http\Controllers\ReservationController@index')->name('reservation.download');
    
});

Route::prefix('admin')->middleware(['auth'])->middleware('can:admin-higher')->group(function(){
    Route::get('/news', 'App\Http\Controllers\NotificationController@show')->name('notification.create');
    
    Route::get('/notification_new', 'App\Http\Controllers\NotificationController@create')->name('notification.new');
    Route::post('/notification_new', 'App\Http\Controllers\NotificationController@store')->name('notification.store');
    
    Route::get('/notification_edit/{id}', 'App\Http\Controllers\NotificationController@edit')->name('notification.edit');
    Route::post('/notification_edit/{id}', 'App\Http\Controllers\NotificationController@update')->name('notification.update');
    
    Route::get('/notification_delete/{id}', 'App\Http\Controllers\NotificationController@delete')->name('notification.delete');
    Route::post('/notification_delete/{id}', 'App\Http\Controllers\NotificationController@remove')->name('notification.remove');

    Route::get('/download', 'App\Http\Controllers\ReservationController@index')->name('reservation.download');
    Route::get('/export', 'App\Http\Controllers\ReservationController@export');

    Route::get('/change_pass', 'App\Http\Controllers\Auth\ChangePasswordController@edit')->name('password.change');
    Route::patch('/change_pass','App\Http\Controllers\Auth\ChangePasswordController@update');
    
    
});

Route::prefix('superuser')->middleware(['auth'])->middleware('can:superuser')->group(function(){
    Route::get('/ResetKey', 'App\Http\Controllers\MakeApiKeyController@ShowAPIKey')->name('ShowAPIKey');
    Route::post('/ResetKey', 'App\Http\Controllers\MakeApiKeyController@ResetKey')->name('ResetKey');
    Route::get('/download', 'App\Http\Controllers\ReservationController@lists_for_super')->name('super.reservation_lists');
    Route::get('/export', 'App\Http\Controllers\ReservationController@super_export');
    Route::get('/hoge', 'App\Http\Controllers\UserProvisioningController@UserProvisioning');
    Route::get('/UserProvisioning', 'App\Http\Controllers\UserProvisioningController@csv_uploader');
    Route::post('/UserProvisioning', 'App\Http\Controllers\UserProvisioningController@upload_regist');

    
});




require __DIR__.'/auth.php';