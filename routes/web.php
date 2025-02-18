<?php

use App\Http\Controllers\JsonImportController;
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
    return view('welcome');
});

Route::get('/importar-json', [JsonImportController::class, 'showForm'])->name('importar.json.form');
Route::post('/importar-json', [JsonImportController::class, 'importJson'])->name('importar.json');


Route::get('/importar-json-medio', [JsonImportController::class, 'importarJsonMedio']);

