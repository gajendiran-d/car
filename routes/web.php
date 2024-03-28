<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('login');
});
Route::middleware(['auth', 'login'])->group(function () {
    Route::resource('/car', 'CarController');
    Route::get('/car/list', [CarController::class, 'carList'])->name('car.list');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
