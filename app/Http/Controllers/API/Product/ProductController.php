<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\ListProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ListProductRequest $request)
    {
        $name = $request->input('name');
        $perPage = $request->input('per_page') ?? 25;
        $query = $this->product->query();

        if ($name) {
            $query->where('name', 'LIKE', "%{$name}%");
        }
        return $this->responsePaginate($query->paginate($perPage));
    }

    /**
     * Display a listing of the resource.
     */
    public function all(ListProductRequest $request)
    {
        $query = $this->product->query();
        $products = $query->all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $product = $this->product->create($request->validated());
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
}
