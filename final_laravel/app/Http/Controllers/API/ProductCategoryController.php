<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = ProductCategory::query()
            ->when(request('search'), function (Builder $query, $search) {
                return $query->where('name', 'like', '%' . $search);
            });

        return $query->simplePaginate();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        return ProductCategory::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the ProductCategory by queryid
        return ProductCategory::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {

        $validated = $request->validate([
            'name' => 'sometimes|required|unique:categories|max:255',
        ]);

        $productCategory->update($validated);

        return $productCategory;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return $productCategory;
    }
}
