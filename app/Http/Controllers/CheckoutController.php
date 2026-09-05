<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
        if (!session()->has('cart') || count(session('cart')) == 0) {
            return redirect()->route('shop.index')->with('info', 'Your cart is empty, your order has already been placed.');
        }

        try {
            $order = $this->orderService->checkout(Auth::id(), [
                'phone'   => $request->phone,
                'address' => $request->address,
            ]);

            return redirect()->route('shop.index')->with('success', 'Your order has been successfully registered! Order number: #' . $order->id);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
