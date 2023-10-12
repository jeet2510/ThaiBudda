<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        dd($order);

        return response()->json(['message' => 'Order created successfully', 'data' => $order]);
    }

    public function getUserOrders($userId)
    {
        $orders = Orders::where('user_id', $userId)
            ->select('item_id', 'order_status', 'service_detail', 'payment_amount', 'payment_status')
            ->get();
        return view('orders.userOrder', compact('orders'));
    }

    public function create(Request $request)
    {
        try {
            $lineItem = [
                'price_data' => [
                    'currency' => 'aud',
                    'product_data' => [
                        'name' => $request->get('name')
                    ],
                    'unit_aamount' => $request->get('price')
                ],
                'quantity' => 1
            ];

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', ''));
            $response = $stripe->checkout->sessions->create([
                'line_items' => $lineItem,
                'mode' => 'payment',
                'success_url' => env('DOMAIN') . '/success',
                'cancel_url' => env('DOMAIN') . '/cancel'
            ]);
            // $checkout_session = \Stripe\Checkout\Session::create([
            // ]);


        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine() . $e->getFile()]);
        }
    }
}
