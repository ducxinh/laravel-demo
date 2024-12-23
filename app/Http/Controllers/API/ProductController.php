<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ListProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ListProductRequest $request)
    {
        $name = $request->get('name');
        $perPage = $request->get('per_page') || 25;
        $query = Product::query();

        if ($name) {
            $query->where('name', 'LIKE', "%{$name}%");
        }

        $products = $query->paginate($perPage);
        return response()->json($products);
    }

    /**
     * Display a listing of the resource.
     */
    public function all(ListProductRequest $request)
    {
        $query = Product::query();
        $products = $query->all();
        return response()->json($products);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }

    /**
     * Search for products by name.
     */
    public function search(Request $request)
    {
        $name = $request->get('name');
        $products = Product::where('name', 'LIKE', "%{$name}%")->get();
        return response()->json($products);
    }
}
