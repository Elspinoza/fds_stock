<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): JsonResponse
    {

        $category = Category::create($request->validated());

        return response()->json($category,201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {

        $cat = Category::findOrFail($id);

        return response()->json($cat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {

        $category->update($request->validated());

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {

        $category->delete();

        return response()->json([
            'message' => 'La catégorie à été supprimer avec succès'],
            200);
    }
}
