<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{   
    public function index()
    {
        $orders = Orders::all();
        // dd($orders);

        return view('orders.allOrders', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|unique:orders',
            'order_status' => 'required',
            'user_id' => 'required|integer',
            'payment_id' => 'required|integer',
            'service_detail' => 'required',
            'item_id' => 'required|integer',
            'payment_amount' => 'required|numeric',
        ]);

        $order = Orders::create($request->all());
        dd($orders);

        return response()->json(['message' => 'Order created successfully', 'data' => $order]);
    }

    public function getUserOrders($userId)
    {
        $orders = Orders::where('user_id', $userId)
            ->select('item_id', 'order_status', 'service_detail', 'payment_amount', 'payment_status')
            ->get();
        return view('orders.userOrder', compact('orders'));
    }

}
