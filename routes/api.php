<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SubscribeToWebsite;
use App\Http\Controllers\API\PostWebsite;

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

/*  Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});  */

//Route::get('user-subscribe-to-website', [SubscribeToWebsite::class, 'index']);
Route::post('user-subscribe-to-website', [SubscribeToWebsite::class, 'userSubscribeToWebsite']);
Route::post('post-to-website', [PostWebsite::class, 'postToWebsite']);