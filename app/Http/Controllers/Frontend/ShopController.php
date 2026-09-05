<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function index()
    {
        $products = Product::paginate(config('custom.pagination'));
        return view('front_assets.shop', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with(['images', 'category'])->findOrFail($id);

        $relatedProducts = Product::with('images')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('front_assets.partials.product_details', compact('product', 'relatedProducts'));
    }

    public function newArrivals()
    {
        $products = Product::where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->paginate(config('custom.pagination'));

        return view('front_assets.shop', compact('products'));
    }
}
