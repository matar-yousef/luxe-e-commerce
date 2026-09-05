<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getAllUsers()
    {
        return User::latest()->paginate(config('custom.pagination', 10));
    }
}
