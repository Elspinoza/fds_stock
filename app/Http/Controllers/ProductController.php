<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

//    public static function middleware(): array
//    {
//        return [
//            new Middleware('auth:sanctum', except: ['
//                index,
//                show
//            ']),
//        ];
//    }


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
    public function store(Request $request ,ProductRequest $request1): JsonResponse
    {

        $validated = $request1->validated();

        $product = $request->user()->products()->create($validated);

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
    public function update(Request $request, Product $product): JsonResponse
    {

        Gate::authorize('modify', $product);

        $product->update($request->validate([
            'name' => 'required|string|max:255',
            'description' => 'sometimes|string|max:255',
            'available_quantity' => 'required|integer|min:1',
            'category_id' => 'required|integer|exists:categories,id',
        ]));

        return response()->json([
            'message' => 'Article mis à jour avec succès'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {

        Gate::authorize('modify', $product);

        $product->delete();

        return response()->json([
            'message' => 'L\'article à été supprimer avec succès !'
        ]);
    }
}
