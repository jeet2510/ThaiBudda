<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function paymentIntentsWebhook()
    {
        try {
            Log::info("STRIPE_WEBHOOK_SECRET" . env('STRIPE_WEBHOOK_SECRET'));
            $payload = @file_get_contents('php://input');
            $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
            // $event = \Stripe\Webhook::constructEvent(
            //     $request->getContent(),
            //     $sig_header,
            //     env('STRIPE_WEBHOOK_SECRET')
            // );

            // $endpoint_secret = 'whsec_3e7bcf5874886d6e0640ea657f5cf2e663751ec83e7a8f17b6180c8c9ff8e40a';

            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                env('STRIPE_WEBHOOK_SECRET')
            );
            Log::info(env('STRIPE_WEBHOOK_SECRET'));

            switch ($event->type) {
                case 'checkout.session.completed':
                    $paymentIntent = $event->data->object;
                case 'checkout.session.completed':
                    $paymentIntent = $event->data->object;
                case 'checkout.session.async_payment_succeeded':
                    $paymentIntent = $event->data->object;
                case 'checkout.session.async_payment_failed':
                    $paymentIntent = $event->data->object;
                case 'checkout.session.expired':
                    $paymentIntent = $event->data->object;
                default:
                    echo 'Received unknown event type ' . $event->type;
            }


            return response('', 200);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            Log::info('Invalid payload');
            return response($e->getMessage() . ' >>> ' . $e->getLine(), 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            Log::info(env('STRIPE_WEBHOOK_SECRET') . ' Signature Verification failed. ' . $e);

            return response($e->getMessage() . ' >>> ' . $e->getLine(), 400);
        }
    }
}
