<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersImg;
use App\Http\Controllers\Users;

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
//user register with image public route
Route::post('/register', [UsersImg::class, 'register']);
//user signup
Route::post('/signup', [Users::class, 'signup']);
//user login
Route::post('/login', [Users::class, 'login']);
//user password check
Route::post('checkpassword',[Users::class, 'checkPassword']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
