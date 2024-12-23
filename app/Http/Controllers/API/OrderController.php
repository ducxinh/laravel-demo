<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sampleRequestData = [
            'user_id' => 1,
            'userName' => 'John Doe',
            'userEmail' => 'xinhnd@example.com',
            'description' => 'This is a sample order',
            'total' => 100,
            'product_id' => 1,
        ];
        $status = 'pending';
        $request->merge(['status' => $status]);
        $order = Order::create($request->all());

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}
