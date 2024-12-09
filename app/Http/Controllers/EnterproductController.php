<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterProductRequest;
use App\Models\Enterproduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EnterproductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $enterProducts = Enterproduct::with('product')->get();

        return response()->json($enterProducts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request ,EnterProductRequest $request1): JsonResponse
    {

        $product = Product::findOrFail($request1->product_id);

        $product->available_quantity += $request1->quantity;

        $product-> save();

//        $enterProduct = Enterproduct::create($request->validated());
        $enterProduct = $request->user()->enterproducts()->create($request1->validated());

        return response()->json($enterProduct, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enterproduct $enterProduct): JsonResponse
    {

        $enterProduct ->load('product');

        return response()->json($enterProduct);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnterProductRequest $request, Enterproduct $enterproduct): JsonResponse
    {

        Gate::authorize('modify', $enterproduct);

        $enterproduct->update($request->validated());

        return response()->json([
            'message' => 'Mis a jour effectuer',
            'data' =>$enterproduct]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enterproduct $enterproduct): JsonResponse
    {

        Gate::authorize('modify', $enterproduct);

        $enterproduct->delete();

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }


    public function statistique(): JsonResponse
    {
        // Quantité totale des articles rentrés dans la BDD

        $total_quantity = Enterproduct::sum('quantity');

        // Quantité totale par articles dans la BDD
        $products = Enterproduct::with('product')
            ->selectRaw('product_id, SUM(quantity) as total_quantity')
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'total_quantity' => $item->total_quantity,
                ];
            });

        // Article le plus entrer en stock

        $most_enter = $products->first();

        return response()->json([
            'total_quantity' => $total_quantity,
            'products' => $products,
            'most_enter' => $most_enter
        ]);

    }


    public function statistiquePeriodique(Request $request): JsonResponse
    {

        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Enterproduct::with('product');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $total_quantity = $query->sum('quantity');

        $enterProducts = $query
            ->selectRaw('product_id, SUM(quantity) as total_quantity')
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'total_quantity' => $item->total_quantity,
                ];
            });

        $most_enter = $enterProducts->first();

        return response()->json([

            'total_quantity' => $total_quantity,

            'products' => $enterProducts,

            'most_enter' => $most_enter
        ]);
    }
}
