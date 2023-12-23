<?php

namespace App\Http\Controllers\Veterinary;

use App\Models\Medecine;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function _storecCart(Request $request)
    {
        // Retrieve the product details from the request.
        $productId = $request->productId;
        $product = Medecine::findOrFail($productId);

        if (!$product) {
            return redirect()->route('veterinary.vet_consumptions.create')->with('danger', 'Product not found.');
        }

        // dd($product);

        // Add the product to the cart.
        $name = Str::lower($product->name);
        $cartItem =  Cart::add($product->id, $name, $request->qty, 0.00);
        $cartCount = Cart::count();

        // return redirect()->route('veterinary.vet_consumptions.create', compact('cartItem'))->with('success', 'Product added to cart.');
        return response()->json([
            'data' => $cartItem,
            'cartCount' => $cartCount,
            'message' => 'Product added successfully'
        ]);
    }

    public function _delete(Request $request)
    {
        $cartCount = Cart::count();
        $delete = $request->delete;

        if (empty($delete)) {
            return response()->json(['message' => 'Cart not found!']);
        } else {
            $getItem = Cart::get($delete);

            Cart::remove($delete);

            return response()->json([
                'cartCount' => $cartCount,
                'item' => $getItem->name,
            ]);
        }
    }

    public function _getCart()
    {
        $cartCount = Cart::count();
        return response()->json([
            'cartCount' => $cartCount,
        ]);
    }
}
