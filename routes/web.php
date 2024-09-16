<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\CreateTask;
use App\Livewire\Pages\DeleteTask;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\TodoistCallbackPage;
use App\Livewire\Pages\Welcome;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Welcome::class)->name('welcome');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/create-task', CreateTask::class)->name('create-task');
    Route::get('/delete-task', DeleteTask::class)->name('delete-task');
    Route::get('/todoist/callback', TodoistCallbackPage::class)->name('todoist-callback');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
