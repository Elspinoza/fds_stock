<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterProductRequest;
use App\Models\Enterproduct;
use Illuminate\Http\JsonResponse;

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
    public function store(EnterProductRequest $request): JsonResponse
    {

        $enterProduct = Enterproduct::create($request->validated());

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
        $enterproduct->delete();

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
