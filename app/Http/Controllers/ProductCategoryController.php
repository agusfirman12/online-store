<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.productCategory.index', compact('categories'));
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
        $validateData = request()->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);

        ProductCategory::create($validateData);

        return redirect()->route('manage-category.index')->with('success', 'New Category Added');
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
        $validateData = request()->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);

        ProductCategory::where('id', $id)->update($validateData);

        return redirect()->route('manage-category.index')->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductCategory::destroy($id);
        return redirect('/admin/manage-category')->with('deleted', 'Category Deleted');
    }
}
