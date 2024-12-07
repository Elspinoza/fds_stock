<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutProductRequest;
use App\Models\Outproduct;
use Illuminate\Http\JsonResponse;

class OutproductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $out = Outproduct::all();

        return response()->json($out);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OutProductRequest $request): JsonResponse
    {
        $out = Outproduct::create($request->validated());

        return response()->json($out, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Outproduct $outProduct): JsonResponse
    {
        $outProducts = Outproduct::findOrFail($outProduct);

        return response()->json($outProducts);
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
}
