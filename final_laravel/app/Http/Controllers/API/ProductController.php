<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'material' => 'nullable|string',
            'size' => 'nullable|string',
            'stylecode' => 'nullable|string',
            'collection_id' => 'nullable|exists:collections,id',
            'productcode' => 'nullable|string|unique:products,productcode',
            'color' => 'nullable|string',
            'category_id' => 'required|exists:product_categories,id',
            'images' => 'nullable|array',
            'images.*.urls' => 'required|array',
            'images.*.urls.*' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $product = Product::create($request->except('images'));

            if ($request->has('images')) {
                foreach ($request->images as $imageData) {
                    $product->images()->create([
                        'urls' => $imageData['urls'],
                        'product_id' => $product->id,
                    ]);
                }
            }

            return response()->json(['data' => $product->load('images')], 201);
        } catch (\Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'An error occurred while creating the product.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Load related models
            $product->load(['category', 'collection', 'images']);

            return response()->json(['data' => $product], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Product not found: ' . $e->getMessage());
            return response()->json(['error' => 'Product not found.'], 404);
        } catch (\Exception $e) {
            Log::error('Error retrieving product: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while retrieving the product.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'quantity' => 'sometimes|required|integer|min:0',
            'material' => 'nullable|string',
            'size' => 'nullable|string',
            'stylecode' => 'nullable|string',
            'collection_id' => 'nullable|exists:collections,id',
            'productcode' => 'nullable|string|unique:products,productcode,' . $product->id,
            'color' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:product_categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product->update($request->all());
        return response()->json(['data' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the product.'], 500);
        }
    }
}
