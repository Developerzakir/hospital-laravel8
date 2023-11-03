<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Models\AppointMent;

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


Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'redirect'])->middleware('auth', 'verified');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


//Doctors
Route::get('/add-doctor',[AdminController::class, 'createDoctor']);
Route::post('/store-doctor',[AdminController::class, 'storeDoctor']);
Route::get('/show-doctors',[AdminController::class, 'show_doctors']);
Route::get('/destroy-doctor/{id}',[AdminController::class, 'destroyDoctor']);
Route::get('/edit-doctor/{id}',[AdminController::class, 'editDoctor']);
Route::post('/update-doctor/{id}',[AdminController::class, 'updateDoctor']);


//Appointments
Route::post('/appointment',[HomeController::class, 'appointment']);
Route::get('/myappointment',[HomeController::class, 'myappointment']);
Route::get('/cancel-appointment/{id}',[HomeController::class, 'cancel_appointment']);
Route::get('/show-appointment',[AdminController::class, 'show_appointment']);
Route::get('/approved/{id}',[AdminController::class, 'approved']);
Route::get('/cancel/{id}',[AdminController::class, 'cancel']);


//Send Email to user
Route::get('/email-view/{id}',[AdminController::class, 'emailView']);
Route::post('/send-email/{id}',[AdminController::class, 'sendEmail']);

