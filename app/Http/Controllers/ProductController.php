<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::get();
        return response()->json(['message' => 'All product list', 'products' => $product], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'product_price' => 'required|numeric'
        ]);

        $validatated = $validator->validate();
        $product = Product::create($validatated);
        return response()->json(['message' => 'Product inserted successfully', 'product' => $product], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {


        return response()->json(['message' => 'Single Product', 'product' => $product], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'product_price' => 'required|numeric'
        ]);

        if ($validator->fails()) return response()->json([$validator->errors()->all()], 422);

        $validatated = $validator->validate();

        $product->update($validatated);
        return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
