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
        if (!$id) {
            return response()->json([
                'message' => 'Aucun ID fournit'
            ], 400);
        }

        $cat = Category::find($id);

        if (!$cat) {
            return response()->json([
                'message' => 'La catégorie n\'existe pas'
            ], 422);
        }

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
        $cat = Category::findOrFail($category);

        $cat->delete();

        return response()->json([
            'message' => 'La catégorie à été supprimer avec succès'],
            204);
    }
}