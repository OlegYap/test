<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getMain()
    {
        $products = Product::paginate(10);
        return view('main', compact('products'));
    }
}
