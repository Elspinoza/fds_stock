<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutProductRequest;
use App\Models\Outproduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OutproductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $out = Outproduct::with('product')->get();

        return response()->json($out);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OutProductRequest $request): JsonResponse
    {

        // Récupérer le produit
        $product = Product::findOrFail($request->product_id);

        // Valider les données du produit sortant
        $outproductValid = $request->validated();

        // Vérifier si la quantité demandée est disponible
        if ( $product->available_quantity < $outproductValid['quantity'] ) {
            return response()->json([
                'message' => 'Impossible d\'effectuer cette action car la quantité restant est inferieur à la quantité demandé.',
                'quantité disponible' => $product->available_quantity
            ], 400);
        }

//        $product -> decrement('available_quantity', $outproductValid->quantity);
        $product -> decrement('available_quantity', $outproductValid['quantity']);
//        $product->available_quantity -= $outproductValid->quantity;
        $product -> save();

        $out = Outproduct::create($outproductValid);

        return response()->json($out, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Outproduct $outProduct): JsonResponse
    {
        $outProduct -> load('product');

        return response()->json($outProduct);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OutProductRequest $request, Outproduct $outProduct): JsonResponse
    {
        $outProduct->update($request->validated());

        return response()->json([
            'message' => 'Update successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outproduct $outProduct): JsonResponse
    {
        $outProduct->delete();

        return response()->json([
            'message' => 'Delete successfully'
        ]);
    }


    public function statistique(Request $request)
    {
        $total_quantity = Outproduct::sum('quantity');

        $products = Outproduct::with('product')
            ->selectRaw('product_id, SUM(quantity) as total_quantity')
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->get()
            ->map(function ($outproduct) {
                return [
                    'product_id' => $outproduct->product_id,
                    'product_name' => $outproduct->product->name ?? 'N/A',
                    'total_quantity' => $outproduct->total_quantity,
                ];
            });

        $most_out = $products->first();

        return response()->json([
            'total_quantity_out' => $total_quantity,

            'products' => $products,

            'most_out' => $most_out
        ]);
    }

    public function statistiquePeriodique(Request $request): JsonResponse
    {

        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Outproduct::with('product');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $total_quantity = $query->sum('quantity');

        $products = $query
            ->selectRaw('product_id, SUM(quantity) as total_quantity')
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->get()
            ->map(function ($outproduct) {
                return [
                    'product_id' => $outproduct->product_id,
                    'product_name' => $outproduct->product->name ?? 'N/A',
                    'total_quantity' => $outproduct->total_quantity,
                ];
            });

        $most_out = $products->first();

        return response()->json([
            'total_quantity_out' => $total_quantity,

            'products' => $products,

            'most_out' => $most_out
        ]);
    }
}
