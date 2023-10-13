<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Orders;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

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

    public function store($orderDetail)
    {
        $order = Orders::create($orderDetail);

        return $order;
    }

    public function getUserOrders($userId)
    {
        $orders = Orders::where('user_id', $userId)
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

            $user = auth()->user();
            $item = Items::where('id', $request->get('item_id'))->first();

            $orderDetails = new stdClass();
            $orderDetails->item_id = $item->id;
            $orderDetails->user_id = $user->id;
            $orderDetails->service_detail = $request->get('status');
            $orderDetails->order_status = 'placed';
            $orderDetails->payment_status = 'unpaid';
            $orderDetails->payment_id = 0;
            $orderDetails->payment_amount = $item->price;
            $order = $this->store($orderDetails);

            Log::info('orderDetails >> ' . json_encode($order));

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
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'user_id' => $user->id
                ],
                'mode'        => 'payment',
                'success_url' => route('order.success', $order->id),
                'cancel_url'  => route('order.cancel'),
            ]);

            Log::info('checkout >> ' . json_encode($checkout_session));
            return redirect()->away($checkout_session->url);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine() . $e->getFile()]);
        }
    }
}
