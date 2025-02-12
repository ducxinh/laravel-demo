<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\API\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userName = $request->get('user_name');
        $perPage = $request->get('per_page') ?? 25;
        $query = $this->order->query();

        if ($userName) {
            $query->where('user_name', 'LIKE', "%{$userName}%");
        }
        return $this->responsePaginate($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $defaultStatus = 'pending';
        $user = $request->user();
        $orderData = $request->only(['description']);
        
        $total = 0;
        $orderDetailsData = $request->input('items');
        foreach ($orderDetailsData as $item) {
            $total += $item['quantity'] * $item['price']; // Assuming 'price' is included in the request
        }

        $orderData = array_merge($orderData, [
            'status' => $defaultStatus,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'total' => $total,
        ]);

        $order = $this->order->create($orderData);
        foreach ($orderDetailsData as $item) {
            $item['order_id'] = $order->id;
            OrderDetail::create($item);
        }

        return response()->json($order->load('orderDetails'), 201);
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
