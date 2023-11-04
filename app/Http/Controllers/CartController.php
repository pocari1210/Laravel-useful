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

  public function qtyIncrement($rowId)
  {

    // rowIdを取得したデータを変数$productに格納
    $product = Cart::get($rowId);

    // qty(数量)を1つたしたデータを$updateQty格納
    $updateQty = $product->qty + 1;

    // 第一引数でrowId、第二引数で、数量を増分した変数($updateQty)を指定
    Cart::update($rowId, $updateQty);

    return redirect()->back()->with('success', 'Product increment succesfully!');
  }
  public function qtyDecrement($rowId)
  {

    // rowIdを取得したデータを変数$productに格納
    $product = Cart::get($rowId);

    // qty(数量)を1つひいたデータを$updateQty格納    
    $updateQty = $product->qty - 1;

    // $updateQtyが0より大きい場合、減算処理を実行させる
    if ($updateQty > 0) {
      Cart::update($rowId, $updateQty);
    }

    return redirect()->back()->with('success', 'Product decrement succesfully!');
  }
}
