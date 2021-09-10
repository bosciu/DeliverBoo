<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function main() {
        $restaurants = config('restaurant');
        return view('owner.home');
    }
}