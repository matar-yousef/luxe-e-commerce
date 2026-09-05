<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('front_assets.cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $result = $this->cartService->addToCart($id, $request->quantity);

        if ($result['status'] === 'error') {
            return response()->json($result, 422);
        }

        return response()->json($result);
    }

    public function remove($id)
    {
        $removed = $this->cartService->removeFromCart($id);

        $message = $removed ? 'Product removed successfully' : 'Product not found';
        return redirect()->back()->with($removed ? 'success' : 'error', $message);
    }
}
