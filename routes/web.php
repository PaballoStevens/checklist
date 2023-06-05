<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;
use App\Models\Checklist;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/space/checklists', function () { return view('checklist'); });
    Route::post('/checklists/new', [ChecklistController::class, 'create_list']);
    Route::post('/checklists/new-item', [ChecklistController::class, 'add_item']);
    Route::get('/viewlist/{id}', [ChecklistController::class, 'item_complete'])->name('update');
    Route::get('/clonelist/{id}', [ChecklistController::class, 'clone']);
    Route::post('/checklists/clonelist', [ChecklistController::class, 'clonelist']);
    Route::get('/edit/{id}', [ChecklistController::class, 'edit_list']);
    Route::post('/edit', [ChecklistController::class, 'update_list']);
    Route::get('/space/checklists/{id}', [ChecklistController::class, 'delete'])->name('delete');
    
});


