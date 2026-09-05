<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    public function addToCart($productId, $quantity)
    {
        $product = Product::with('images')->findOrFail($productId);
        $cart = session()->get('cart', []);

        $currentQty = isset($cart[$productId]) ? $cart[$productId]['quantity'] : 0;
        $newQty = $currentQty + $quantity;

        if ($newQty > $product->stock) {
            return [
                'status' => 'error',
                'message' => "Sorry, what's available is {$product->stock} only."
            ];
        }

        $firstImage = $product->images->first();
        $imagePath = $firstImage ? $firstImage->url : 'placeholder.jpg';

        $cart[$productId] = [
            "name"     => $product->name,
            "quantity" => $newQty,
            "price"    => $product->price,
            "image"    => $imagePath
        ];

        session()->put('cart', $cart);

        return [
            'status'     => 'success',
            'message'    => 'Added to cart successfully!',
            'cart_count' => count($cart)
        ];
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return true;
        }

        return false;
    }
}
