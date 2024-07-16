<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function getUserAddresses(User $user)
    {
        return $user->addresses; // Assumes addresses relationship is correctly defined
    }
}
