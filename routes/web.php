<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

Route::get('/',function(){
   return redirect('/project');
});

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Auth::routes();

Route::resource('/project',ProjectController::class)->middleware('auth');

Route::post('/project/{pro}/tasks',[TaskController::class,'store'])->middleware('auth');

Route::patch('/project/{pro}/tasks/{task}',[TaskController::class,'update'])->middleware('auth');

Route::delete('/project/{pro}/tasks/{task}',[TaskController::class,'destroy'])->middleware('auth');

Route::get('/profile',[ProfileController::class,'index'])->middleware('auth');

Route::patch('/profile',[ProfileController::class,'update'])->middleware('auth');