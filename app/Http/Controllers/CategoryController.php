<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
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
        $categories = Category::all();

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request ,CategoryRequest $request1): JsonResponse
    {

        $validated = $request1->validated();

        $category = $request->user()->categories()->create($validated);

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
    public function update(Request $request, Category $category): JsonResponse
    {

        Gate::authorize('modify', $category);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $category->update($validated);

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {

        Gate::authorize('modify', $category);

        $category->delete();

        return response()->json([
            'message' => 'La catégorie à été supprimer avec succès'],
            200);
    }
}
