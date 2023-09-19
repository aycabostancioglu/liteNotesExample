<?php

use App\Http\Controllers\NoteController;
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
    return view('welcome');
});



//jetstream

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    //Kişilerin login olmadan girmesini istemediğimiz yapılar
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //Note routeları

    Route::get('/notes',[NoteController::class,'index'])->name('notes_index');
    Route::get('/notes/createPage',[NoteController::class,'createPage'])->name('notes_createPage'); //create
    Route::post('/notes/addNote',[NoteController::class,'addNote'])->name('notes_addNote'); //store


    Route::get('/notes/detail/{note}',[NoteController::class,'detail1'])->name('notes_detail1');
    Route::get('/notes/update/{note_id}',[NoteController::class,'update'])->name('notes_update');
    //Form güncelleme post
    Route::post('/notes/update/edit/{note_id}',[NoteController::class,'edit'])->name('notes_editNote');


    Route::post('/notes/update/edit',[NoteController::class,'editNoParameter'])->name('notes_editNoteParameter');

});



//// Test Route Başlangıç
///
///

Route::get('/masterTest',function (){
    return view('front.layouts.master');
});
///
///
///
/// Test Route Bitiş
