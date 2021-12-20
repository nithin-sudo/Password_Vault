<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaultController;
use App\Http\Controllers\StudentController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('vaults', [VaultController::class,'index'])->name('vaults.index');
//Route::get('vaults/sites', [VaultController::class, 'showSites'])->name('vaults.sites');

Route::get('vaults/create', [VaultController::class,'create'])->name('vaults.create');
Route::post('vaults/store', [VaultController::class,'store'])->name('vaults.store');

Route::get('vaults/edit/{id}', [VaultController::class,'edit'])->name('vaults.edit');
Route::post('vaults/update/{id}', [VaultController::class,'update'])->name('vaults.update');

Route::post('vaults/displaypassword/{id}', [VaultController::class,'showPassword'])->name('vaults.showpassword');

Route::post('vaults/validatepassword', [VaultController::class,'validatePassword'])->name('vaults.password');

Route::get('vaults/destroy/{id}', [VaultController::class,'destroy'])->name('vaults.destroy');

Route::get('users', [VaultController::class,'userIndex'])->name('users.index');
Route::get('users/display', [VaultController::class,'showUsers'])->name('users.display');

Route::get('students', [StudentController::class, 'index']);
Route::get('students/list', [StudentController::class, 'getStudents'])->name('students.list');

require __DIR__.'/auth.php';
