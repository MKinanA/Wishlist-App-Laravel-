<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DataController::class, 'index']);

Route::put('/new', [DataController::class, 'create']);

Route::delete('/delete', [DataController::class, 'delete']);

Route::post('/edit', [DataController::class, 'edit']);

Route::put('/update', [DataController::class, 'update']);