<?php

use App\Http\Controllers\FallbackController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupPersonController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RelationshipController;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Database\Eloquent\Factories\Relationship;
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


// PersonController
// GET
Route::get('/People', [PersonController::class, 'index'])->name('People.Manage');
Route::get('/People/{id}', [PersonController::class, 'show'])
    ->where([
        'id' => '[0-9]+'
    ])->name('People.Show');

// POST
Route::get('/People/Create', [PersonController::class, 'create'])->name('People.Create');
Route::post('/People', [PersonController::class, 'store'])->name('People.Store');

// PUT OR PATCH
Route::get('/People/edit/{id}', [PersonController::class, 'edit'])->name('People.Edit');
Route::patch('/People/{id}', [PersonController::class, 'update'])->name('People.Update');

// Delete
Route::delete('/People/{id}', [PersonController::class, 'destroy'])->name('People.Destroy');



// RelationshipController
// GET
Route::get('/Relationship', [RelationshipController::class, 'index'])->name('Rship.Manage');
Route::get('/Relationship/{id}', [RelationshipController::class, 'show'])
    ->where([
        'id' => '[0-9]+'
    ])->name('Rship.Show');

// POST
Route::get('/Relationship/Create', [RelationshipController::class, 'create'])->name('Rship.Create');
Route::post('/Relationship', [RelationshipController::class, 'store'])->name('Rship.Store');

// PUT OR PATCH
Route::get('/Relationship/edit/{id}', [RelationshipController::class, 'edit'])->name('Rship.Edit');
Route::patch('/Relationship/{id}', [RelationshipController::class, 'update'])->name('Rship.Update');

// Delete
Route::delete('/Rship/{id}', [RelationshipController::class, 'destroy'])->name('Rship.Destroy');



// GroupController
// GET
Route::get('/Group', [GroupController::class, 'index'])->name('Group.Manage');
Route::get('/Group/{id}', [GroupController::class, 'show'])
    ->where([
        'id' => '[0-9]+'
    ])->name('Group.Show');

// POST
Route::get('/Group/Create', [GroupController::class, 'create'])->name('Group.Create');
Route::post('/Group', [GroupController::class, 'store'])->name('Group.Store');

// PUT OR PATCH
Route::get('/Group/edit/{id}', [GroupController::class, 'edit'])->name('Group.Edit');
Route::patch('/Group/{id}', [GroupController::class, 'update'])->name('Group.Update');

// Delete
Route::delete('/Group/{id}', [GroupController::class, 'destroy'])->name('Group.Destroy');


// GroupPersonController
// GET
Route::get('/Group_member', [GroupPersonController::class, 'index'])->name('Grpmbr.Manage');
Route::get('/Group_member/{id}', [GroupPersonController::class, 'show'])
    ->where([
        'id' => '[0-9]+'
    ])->name('Grpmbr.Show');

// POST
Route::get('/Group_member/Create', [GroupPersonController::class, 'create'])->name('Grpmbr.Create');
Route::post('/Group_member', [GroupPersonController::class, 'store'])->name('Grpmbr.Store');

// PUT OR PATCH
Route::get('/Group_member/edit/{id}', [GroupPersonController::class, 'edit'])->name('Grpmbr.Edit');
Route::patch('/Group_member/{id}', [GroupPersonController::class, 'update'])->name('Grpmbr.Update');

// Delete
Route::delete('/Group_member/{group_id}{member_id}', [GroupPersonController::class, 'destroy'])->name('Grpmbr.Destroy');
// Route::resource('People', PersonController::class);

// Multiple HTTP verbs
// Route::match(['GET', 'POST'], '/People', [PersonController::class, 'index']);
// Route::any('/People', [PersonController::class, 'index']);

// Return view
// Route::view('/People', 'People.person_manager', ['name'=>"Code With Dary"]);


Route::resource('/', PostsController::class);
