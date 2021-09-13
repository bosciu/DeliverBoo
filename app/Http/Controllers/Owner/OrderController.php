<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Order;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index(){
        $userId = Auth::id();
        $restaurants = Restaurant::where('user_id', $userId)->get();
        foreach ($restaurants as $restaurant) {
            $orders[$restaurant->name] = $restaurant->orders;
        }
        return view('owner.order.index', compact('orders'));
    }

    public function show(Order $order){
        return view('owner.order.show', compact('order'));
    }
}
