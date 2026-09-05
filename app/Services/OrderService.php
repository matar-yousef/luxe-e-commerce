<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OrderService
{
    public function checkout($userId, array $contactDetails)
    {
        $cart = Session::get('cart', []);
        $total = array_reduce($cart, function ($i, $obj) {
            return $i + ($obj['price'] * $obj['quantity']);
        }, 0);

        if (empty($cart)) {
            throw new \Exception('The cart is empty, cannot complete the order.');
        }

        return DB::transaction(function () use ($userId, $cart, $total, $contactDetails) {
            $order = Order::create([
                'user_id'     => $userId,
                'total_price' => $total,
                'status'      => 'pending',
                'phone'       => $contactDetails['phone'] ?? null,
                'address'     => $contactDetails['address'] ?? null,
            ]);

            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $id,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }

            Session::forget('cart');

            return $order;
        });
    }
}
