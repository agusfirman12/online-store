<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Product::all());
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
            'name'                  => 'required|max:255',
            'stock'                 => 'required',
            'price'                 => 'required',
            'description'           => 'required',
            'photo'                 => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'status'                => 'required',
            'product_category_id'   => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => $validator->errors(),
            ], 401);
        }

        
        $dataProduct = new Product;
        if ($request->hasFile('photo')) {
            $dataProduct->photo = $request->file('photo')->store('product-image');
        }elseif (!$request->has('photo')) {
        // If the 'photo' key does not exist in the request, skip the file upload
        unset($dataProduct->photo);
        }
        $dataProduct->product_category_id = $request->product_category_id;
        $dataProduct->name = $request->name;
        $dataProduct->description = $request->description;
        $dataProduct->status = $request->status;
        $dataProduct->stock = $request->stock;
        $dataProduct->slug = Str::limit(strip_tags($request->description, 100));;
        $dataProduct->price = $request->price;

        $product = $dataProduct->save();



        return response()->json([
            'success' => true,
            'message' => 'Product add Successfully',
            'data' => $product,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dataProduct = Product::find($id);
        if (empty($dataProduct)) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Product found', 
            'data' => $dataProduct
        ]);
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
         // Find the product by ID
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max size
            'status' => 'required',
            'product_category_id' => 'required',
        ]);

        // Handle photo upload if exists
        if ($request->hasFile('photo')) {
            // Delete the old photo if exists
            if ($product->photo) {
                Storage::delete($product->photo);
            }

            // Store the new photo and get the path
            $photoPath = $request->file('photo')->store('photos');
            $product->photo = $photoPath;
        }

        // Update the product with the validated data
        $product->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'product_category_id' => $request->product_category_id,
        ]);

        // If photo was updated
        if ($request->hasFile('photo')) {
            $product->photo = $photoPath;
        }

        return response()->json(['message' => 'Product updated successfully.', 'product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Product Deleted',
        ]);
    }
}
