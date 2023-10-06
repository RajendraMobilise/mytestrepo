<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::post('/submit-form', [HomeController::class, 'submitForm']);

Route::get('cmd', function () {

\Artisan::call('migrate --path=/database/migrations/2023_02_21_192713_create_user_menu_permsins_table.php');

dd("Cache is cleared");

});
Route::get('mid', function () {

\Artisan::call('make:middleware AdminAuth');

dd("Cache is cleared");

});
Route::get('config', function () {

\Artisan::call('config:cache');

dd("Cache is cleared");

});