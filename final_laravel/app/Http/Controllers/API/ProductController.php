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
     * @unauthenticated
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
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $product = Product::create($request->except('images'));

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $product->addMedia($image)
                        ->withCustomProperties(['order_column' => $index + 1])
                        ->toMediaCollection('products');
                }
            }

            return response()->json(['data' => $product->load('media')], 201);
        } catch (\Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['error' => 'An error occurred while creating the product.'], 500);
        }
    }

    /**
     * Display the specified resource.
     * @unauthenticated
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Load related models
            $product->load(['category', 'collection']);

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
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'material' => 'nullable|string',
            'size' => 'nullable|string',
            'stylecode' => 'nullable|string',
            'collection_id' => 'nullable|exists:collections,id',
            'productcode' => 'nullable|string|unique:products,productcode,' . $product->id,
            'color' => 'nullable|string',
            'category_id' => 'sometimes|exists:product_categories,id',
            'images' => 'nullable|array',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $product->fill($request->except('images'));
            $product->save();

            if ($request->hasFile('images')) {
                $product->clearMediaCollection('products');
                foreach ($request->file('images') as $index => $image) {
                    $product->addMedia($image)
                        ->withCustomProperties(['order_column' => $index + 1])
                        ->toMediaCollection('products');
                }
            }

            return response()->json(['data' => $product->load('media')], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update product', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        try {
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete product', 'error' => $e->getMessage()], 500);
        }
    }
}
