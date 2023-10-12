<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
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
