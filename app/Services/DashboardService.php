<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;

class DashboardService
{
    public function getDashboardStats()
    {
        return [
            'productsCount'   => Product::count(),
            'categoriesCount' => Category::count(),
            'usersCount'      => User::count(),
            'ordersCount'     => Order::count(),
        ];
    }
}
