<?php

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
    return view('homeview');
});

Route::get('/viewhome', function () {
    return view('homeview');
});
Route::get('/signin', function () {
    return view('SignIn');
});
Route::get('/signup', function () {
    return view('SignUp');
});

Auth::routes();
Route::delete('/tasks/{id}', 'App\Http\Controllers\TasksController@destroy')->name('tasks.destroy');

Route::post('/addtask/create', [App\Http\Controllers\TasksController::class, 'create'])->name('addtask.create');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/tasks/{id}/update-name', 'App\Http\Controllers\TasksController@updateName')->name('tasks.updateName');
Route::post('/tasks/{id}/update-done', 'App\Http\Controllers\TasksController@donefunction')->name('tasks.donefunction');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/addtasks', [App\Http\Controllers\TasksController::class, 'index'])->name('tasklist');
    Route::get('/donetasks', [App\Http\Controllers\TasksController::class, 'index1'])->name('tasklist');
    
});
