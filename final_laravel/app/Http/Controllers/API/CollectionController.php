<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
{

    /**
     * Display a listing of collection.
     * @unauthenticated
     */
    public function index()
    {
        return Collection::all();
    }

    /**
     * Display a particular collection.
     * @unauthenticated
     */
    public function show($id)
    {
        $collection = Collection::find($id);

        if (!$collection) {
            return response()->json(['message' => 'Collection not found'], 404);
        }

        return response()->json($collection);
    }

    /**
     * Creating a new collection.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $collection = Collection::create($request->all());

        return response()->json($collection, 201);
    }

    /**
     * Updating a collection.
     */
    public function update(Request $request, $id)
    {
        $collection = Collection::find($id);

        if (!$collection) {
            return response()->json(['message' => 'Collection not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $collection->update($request->all());

        return response()->json($collection);
    }

    /**
     * Deleting a collection.
     */
    public function destroy($id)
    {
        $collection = Collection::find($id);

        if (!$collection) {
            return response()->json(['message' => 'Collection not found'], 404);
        }

        $collection->delete();

        return response()->json(['message' => 'Collection deleted successfully']);
    }
}
