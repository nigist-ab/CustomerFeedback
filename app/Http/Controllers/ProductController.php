<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Fetch all products from the database

        return Inertia::render('Products/Index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        return Inertia::render('Products/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'PRODUCTNAME' => 'required|string|max:255', // Validate only PRODUCTNAME
        ]);

        Product::create($request->only('PRODUCTNAME')); // Save only PRODUCTNAME

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }
}
