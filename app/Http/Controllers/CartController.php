<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
  public function shop()
  {
    $products = Product::all();
    return view('cart.shop', compact('products'));
  }

  public function cart()
  {
    return view('cart.cart');
  }
}
