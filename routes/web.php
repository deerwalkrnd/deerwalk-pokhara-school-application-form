<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $provinces = ['Bagmati', 'Lumbini', 'Gandaki', 'Koshi', 'Madhesh', 'Sudur-Paschim', 'Karnali'];
    return view('form', compact("provinces"));
})->name('home');
// Route::get('/home/send/adminmail', [FormController::class, 'sendTestMail']);
Route::post('/form/post', [FormController::class, 'create'])->name('form.store');
Route::get("/form/success", [FormController::class, 'success'])->name('form.success');

