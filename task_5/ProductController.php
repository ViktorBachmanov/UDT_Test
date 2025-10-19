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
            'price' => 'required|integer',
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
    public function update(Request $request, int $productId)
    {
        $request->validate([
            'price' => 'sometimes|integer',
            'quantity' => 'sometimes|integer',
        ]);

        $product = Product::findOrFail($productId);

        if ($request->filled('name')) {
            $product->name = $request->input('name');
        }
        if ($request->filled('art')) {
            $product->art = $request->input('art');
        }
        if ($request->filled('price')) {
            $product->price = $request->input('price');
        }
        if ($request->filled('quantity')) {
            $product->quantity = $request->input('quantity');
        }

        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $productId)
    {
        $product = Product::findOrFail($productId);

        $product->delete();
    }
}

