<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
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

  public function addToCart($product_id)
  {
    $product = Product::findOrFail($product_id);

    // dd($product);

    Cart::add([
      'id' => $product->id,
      'name' => $product->name,
      'qty' => 1,
      'price' => $product->price,
      'weight' => 0,

      // optionsキーは、任意の物を記述できる
      'options' => [
        'image' => $product->image
      ]
    ]);

    return redirect()->back()->with('success', 'Product is added into the cart!');
  }
}
