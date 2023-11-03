<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\DataTables\UsersDataTable;
use App\Models\User;

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


Route::get('user/{id}/edit', function ($id) {
  return $id;
})->name('user.edit');

Route::get('/dashboard', function (UsersDataTable $dataTable) {
  // $users = User::all();
  // $users = User::paginate(10);
  // return view('dashboard', compact('users'));

  // ★YajraDBを使用する場合のreturnの処理★
  // renderの中にview名を記述する
  return $dataTable->render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
