<?php

namespace App\Http\Controllers;

use App\Models\Outproduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Outproduct $outproduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outproduct $outproduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Outproduct $outproduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outproduct $outproduct)
    {
        //
    }
}
