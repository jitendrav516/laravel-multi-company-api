<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

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
    return view('welcome');
});

Route::get('/frontend', function () {
    return view('frontend');
});

// Route::get('/register-page', 'FrontendController@register'); 
// Route::get('/login-page', 'FrontendController@login'); 
// Route::get('/companies-page', 'FrontendController@companies');    


Route::get('/register-page', [FrontendController::class, 'register']);
Route::get('/login-page', [FrontendController::class, 'login']);
Route::get('/companies-page', [FrontendController::class, 'companies']);