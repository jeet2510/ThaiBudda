<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Orders;
use App\Models\Items;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Orders::all();
        foreach ($orders as $order) {
            $item = Items::where('id', $order->item_id)->first();
            $order->item_name = $item->name;
        }
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

        return response()->json(['message' => 'Order created successfully', 'data' => $order]);
    }

    public function getUserOrders($userId)
    {
        $orders = Orders::where('user_id', $userId)
            ->select('order_id', 'item_id', 'order_status', 'service_detail', 'payment_amount', 'payment_status')
            ->get();

        foreach ($orders as $order) {
            $item = Items::where('id', $order->item_id)->first();
            $order->item_name = $item->name;
        }
        return view('orders.userOrder', compact('orders'));
    }

    public function create(Request $request)
    {
        try {
            // $lineItem = [
            //     'price_data' => [
            //         'currency' => 'aud',
            //         'product_data' => [
            //             'name' => $request->get('name')
            //         ],
            //         'unit_amount' => $request->get('price')
            //     ],
            //     'quantity' => 1
            // ];

            $user = auth()->user();
            $item = Items::where('id', $request->get('item_id'))->first();

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', ''));
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET', ''));
            $checkout_session = \Stripe\Checkout\Session::create([
                'line_items'  => [
                    [
                        'price_data' => [
                            'currency'     => 'aud',
                            'product_data' => [
                                'name' => $item->name
                            ],
                            'unit_amount'  => (int)($item->price) * 100
                        ],
                        'quantity'   => 1
                    ],
                ],
                'metadata' => [
                    'item_id' => $item->id,
                    'user_id' => $user->id
                ],
                'mode'        => 'payment',
                'success_url' => route('order.success'),
                'cancel_url'  => route('order.cancel'),
            ]);
            // dd('ok');
            // $checkout_session = \Stripe\Checkout\Session::create([
            // ]);

            Log::info('checkout >> ' . json_encode($checkout_session));
            return redirect()->away($checkout_session->url);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine() . $e->getFile()]);
        }
    }
}
