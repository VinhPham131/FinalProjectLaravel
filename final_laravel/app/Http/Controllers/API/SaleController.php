<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    /**
     * Show all sales.
     * @unauthenticated
     */
    public function index()
    {
        $sales = Sale::all();
        return response()->json($sales);
    }
    /**
     * Display a particular sale.
     * @unauthenticated
     */
    public function show($id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }

        return response()->json($sale);
    }
    /**
     * Creating a new sale.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sale_target_type' => 'required|string|in:product,category,collection',
            'sale_target_id' => 'required|integer',
            'percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $sale = Sale::create($request->all());

        return response()->json($sale, 201);
    }
    /**
     * Updating a Sale.
     */
    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'sale_target_type' => 'nullable|string|in:product,category,collection',
            'sale_target_id' => 'nullable|integer|required_with:sale_target_type',
            'percentage' => 'nullable|numeric|min:0|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $sale->fill($request->all());
            $sale->save();
            return response()->json(['data' => $sale->fresh()], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update sale', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Deleting a sale.
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }

        $sale->delete();

        return response()->json(['message' => 'Sale deleted successfully']);
    }
}
