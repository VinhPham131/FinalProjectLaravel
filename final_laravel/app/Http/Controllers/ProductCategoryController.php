<?php
namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all product categories and return a view
        $categories = ProductCategory::all();
        return $categories;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a view with a form to create a new product category
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        // Create a new product category
        return ProductCategory::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the product category by ID and return a view
        return ProductCategory::find($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the product category by ID and return the edit form
        $category = ProductCategory::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|unique:categories|max:255',
        ]);

        return $category->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the product category by ID and delete it
        $category = ProductCategory::findOrFail($id);
        return $category->delete();
    }
}