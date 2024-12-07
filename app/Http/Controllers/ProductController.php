<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $products = Product::with('category')->get();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): JsonResponse
    {

        $product = Product::create($request->validated());

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {

        $prod = Product::findOrFail($id);

        if (!$prod) {
            return response()->json([
                'message' => 'L\'article n\'existe pas'
            ], 404);
        }

        return response()->json($prod);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {

        $product->update($request->validated());

        return response()->json([
            'message' => 'Article mis à jour avec succès'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {

        $product->delete();

        return response()->json([
            'message' => 'L\'article à été supprimer avec succès !'
        ]);
    }
}
