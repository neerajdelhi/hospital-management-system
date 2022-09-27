<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;


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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [HomeController::class,'index']);
Route::get('/home',[App\Http\Controllers\HomeController::class,'redirect']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/add_doctor_view', [AdminController::class,'addview']);

Route::post('/upload_doctor', [AdminController::class,'upload']);

Route::post('/appointment', [HomeController::class,'appointment']);

Route::get('/myappointments', [HomeController::class,'myappointment'])->name('myappointment');
 
Route::get('/cancel_appointment/{id}', [HomeController::class,'cancel_appointment'])->name('cancel_appointment');

Route::get('/test', function(){
    return "test";
});
