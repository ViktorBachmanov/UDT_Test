<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'art' => 'required',
            'price' => 'required',
        ]);

        $input = $request->all();

        return Product::create([
            'name' => $input['name'],
            'art' => $input['art'],
            'price' => $input['price'],
            'quantity' => $input['quantity'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $product->update([
            'name' => $input['name'],
            'art' => $input['art'],
            'price' => $input['price'],
            'quantity' => $input['quantity'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}

