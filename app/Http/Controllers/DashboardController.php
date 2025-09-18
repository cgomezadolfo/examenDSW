<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_clients' => Client::count(),
            'low_stock_products' => Product::whereRaw('stock_actual <= stock_bajo')->count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_products' => Product::latest()->take(5)->get(),
            'recent_clients' => Client::latest()->take(5)->get(),
        ];

        return view('dashboard', compact('stats'));
    }
}
