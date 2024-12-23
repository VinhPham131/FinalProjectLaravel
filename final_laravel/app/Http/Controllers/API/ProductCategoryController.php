<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductCategory::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'required|unique:product_categories|max:255',
            ]);

            // Create a new product category
            $category = ProductCategory::create($validated);

            return response()->json($category, 201);
        } catch (\Exception $e) {
            Log::error('Error creating product category: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while creating the product category.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = ProductCategory::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Find the product category by ID
            $category = ProductCategory::findOrFail($id);

            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'sometimes|required|unique:product_categories,name,' . $id . '|max:255',
            ]);

            // Update the product category
            $category->update($validated);

            return response()->json($category, 200);
        } catch (\Exception $e) {
            Log::error('Error updating product category: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the product category.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the product category by ID
            $category = ProductCategory::findOrFail($id);

            // Attempt to delete the category
            $deleted = $category->delete();

            if ($deleted) {
                return response()->json(['message' => 'Category deleted successfully.'], 200);
            } else {
                Log::error('Failed to delete product category: ' . $id);
                return response()->json(['error' => 'Failed to delete the product category.'], 500);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Product category not found: ' . $id);
            return response()->json(['error' => 'Category not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error deleting product category: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the product category.'], 500);
        }
    }
}
