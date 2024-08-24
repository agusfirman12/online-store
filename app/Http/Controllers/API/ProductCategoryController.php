<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ProductCategory::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => $validator->errors(),
            ], 401);
        }

        $dataProductCategory = new ProductCategory;
        $dataProductCategory->name = $request->name;
        $dataProductCategory->description = $request->description;
        $dataProductCategory->status = $request->status;
        $dataProductCategory->save();

        return response()->json([
            'success' => true,
            'message' => 'Product Category Added',
            'data' => $dataProductCategory
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(ProductCategory::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the category by ID
        $category = ProductCategory::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404);
        }

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required',
        ]);

        // Update the category with the validated data
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'Category updated successfully.', 'category' => $category], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductCategory::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Product Category Deleted',
        ]);
    }
}
