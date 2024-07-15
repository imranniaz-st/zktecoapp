<?php
use App\Http\Controllers\ZKTecoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::post('/devices/status', [ZKTecoController::class, 'checkMultipleStatus']);


Route::get('/device/status/{ip}/{port?}', [ZKTecoController::class, 'checkStatus']);
 Route::get('/devices/status', [ZKTecoController::class, 'checkMultipleStatus']);


Route::get('/devices/form', [ZKTecoController::class, 'showForm']);
    Route::get('/devices/form', [ZKTecoController::class, 'showForm']);

