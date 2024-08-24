<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = ProductCategory::all();
        return view('admin.products.index', compact('products', 'categories'));
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
        $validatedData = $request->validate([
            'name'                  => 'required|max:255',
            'stock'                 => 'required',
            'price'                 => 'required',
            'description'           => 'required',
            'photo'                 => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'status'                => 'required',
            'product_category_id'   => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('product-image');
        }elseif (!$request->has('photo')) {
        // If the 'photo' key does not exist in the request, skip the file upload
        unset($validatedData['photo']);
        }
        
        $validatedData['slug'] = Str::limit(strip_tags($request->description, 100));

        Product::create($validatedData);

        return redirect(route('admin.product'))->with('success', 'New Product Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Product::find($id));
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
        $rules = [
            'name'                  => 'required|max:255',
            'stock'                 => 'required',
            'price'                 => 'required',
            'description'           => 'required',
            'photo'                 => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'status'                => 'required',
            'product_category_id'   => 'required',
        ];

        $validatedData = $request->validate($rules);
        
        $product = Product::find($id);

        // Handle photo upload if exists
        if ($request->hasFile('photo')) {
            // Delete the old photo if exists
            if ($product->photo) {
                Storage::delete($product->photo);
            }

            // Store the new photo and get the path
            $photoPath = $request->file('photo')->store('product-image');
            $product->photo = $photoPath;
        }

        $validatedData['slug'] = Str::limit(strip_tags($request->description, 100));

        Product::where('id', $id)->update($validatedData);

        return redirect(route('admin.product'))->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect(route('admin.product'))->with('deleted', 'Product Deleted');
    }
}
