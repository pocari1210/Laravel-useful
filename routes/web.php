<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\DataTables\UsersDataTable;
use App\Helpers\ImageFilter;
use Intervention\Image\ImageManagerStatic;
use App\Models\User;
use App\Http\Controllers\CartController;

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


Route::get('image', function () {
  $img = ImageManagerStatic::make('car.jpg');

  $img->filter(new ImageFilter(15));

  // $img->save('car1.jpg', 80);
  return $img->response();
});


Route::get('shop', [CartController::class, 'shop'])
  ->name('shop');

Route::get('cart', [CartController::class, 'cart'])
  ->name('cart');

// productをCartに追加するルート
Route::get('add-to-cart/{product_id}', [CartController::class, 'addToCart'])
  ->name('add-to-cart');


Route::get('qty-increment/{rowId}', [CartController::class, 'qtyIncrement'])
  ->name('qty-increment');

Route::get('qty-decrement/{rowId}', [CartController::class, 'qtyDecrement'])
  ->name('qty-decrement');

Route::get('remove-product/{rowId}', [CartController::class, 'removeProduct'])
  ->name('remove-product');
