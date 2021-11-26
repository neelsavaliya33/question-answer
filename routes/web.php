<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionAnswerController;
use App\Models\Category;
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
    return view('index', [
        'data' => Category::with('question', 'question.answers')->get()
    ]);
})->name('home');

Route::resource('category', CategoryController::class);
Route::resource('question', QuestionAnswerController::class);
