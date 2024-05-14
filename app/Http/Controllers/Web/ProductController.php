<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\ProductCreateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
      $products = Product::paginate(6);
      $cart_data = $request->session()->get('cart');
      return view("products.index",compact('products','cart_data'));
    }

    public function addToCart(Request $request)
    {

    $product = Product::find( $request->id );
     $productId = $request->input('id');
     $cart = $request->session()->get('cart', []);

    if (array_key_exists($productId, $cart)) {
        $cart[$productId]['quantity'] += 1;
        $cart[$productId]['price'] += $product->price;
    } else {
        // Fetch item details from the database or wherever you store them
        $product = Product::find($productId);
        if ($product) {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image'  => $product->image,
                'description'=>$product->description
            ];
        }
    }
    $request->session()->put('cart', $cart);
    $cart_data = $request->session()->get('cart');
    return response()->json(['cart_data'=>$cart_data, 'item_count'=>count($cart_data), 'message' => 'Item added to cart successfully'], 200);
    }


}
