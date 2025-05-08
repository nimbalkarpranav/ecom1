<?php
namespace App\Http\Controllers;

use App\Models\tbl_product;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = tbl_product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'img' => $product->img
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
