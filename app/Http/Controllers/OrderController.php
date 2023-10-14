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
        $orders = Orders::whereDate('created_at', '>=', now()->subDays(7))
                            ->orderBy('created_at', 'desc')
                            ->paginate(20);
        foreach ($orders as $order) {
            $item = Items::where('id', $order->item_id)->first();
            $order->item_name = $item->name;
        }
        return view('orders.allOrders', compact('orders'));
    }

    public function store($orderDetail)
    {
        // dd($orderDetail);
        $order = Orders::create([
            'item_id' => $orderDetail->item_id,
            'user_id' => $orderDetail->user_id,
            'service_detail' => $orderDetail->service_detail,
            'order_status' => $orderDetail->order_status,
            'payment_status' => $orderDetail->payment_status,
            'payment_id' => $orderDetail->payment_id,
            'payment_amount' => $orderDetail->payment_amount
        ]);

        return $order;
    }

    public function getUserOrders($userId)
    {
        $orders = Orders::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
            $type = $request->get('type');

            $orderDetails = new stdClass();
            $orderDetails->item_id = $item->id;
            $orderDetails->user_id = $user->id;
            $orderDetails->service_detail = $type;
            $orderDetails->order_status = 'Placed';
            $orderDetails->payment_status = 'Unpaid';
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
                'success_url' => route('order.success'),
                'cancel_url'  => route('order.cancel'),
            ]);

            Log::info('checkout >> ' . json_encode($checkout_session));
            return redirect()->away($checkout_session->url);
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine() . $e->getFile()]);
        }
    }

    public function changeOrderStatus($id, Request $request)
    {
        try {
            $updateOrder = Orders::where('id', $id)->update([
                'order_status' => $request->orderStatus
            ]);

            return redirect()->route('allOrders');
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine() . $e->getFile()]);
        }
    }

    public function orderFilter(Request $request){
        // $orders = Orders::whereDate('created_at', '>=', now()->subDays(7))
        //                     ->orderBy('created_at', 'desc')
        //                     ->paginate(20);


        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
    
        if ($fromDate && $toDate) {
            $orders = Orders::whereBetween('created_at', [$fromDate, $toDate])
                ->paginate(5);
        } else {
            $orders = Orders::whereDate('created_at', '>=', now()->subDays(7))
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
    
             
        foreach ($orders as $order) {
            $item = Items::where('id', $order->item_id)->first();
            $order->item_name = $item->name;
        }
        return view('orders.filterOrders', ['fromDate' => $fromDate, 'toDate' => $toDate, 'orders'=>$orders]);
    }
}
