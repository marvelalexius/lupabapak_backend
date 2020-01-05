<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller
{
    public function index() {
        $product = new Product();

        $products = $product->all();

        return response()->json([
            'message' => 'success',
            'data' => $products,
            'code' => 200
        ], 200);
    }

    public function show(Product $product) {
        return response()->json([
            'message' => 'success',
            'data' => $product,
            'code' => 200
        ], 200);
    }
}
