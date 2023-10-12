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
                case 'payment_intent.created':
                    $paymentIntent = $event->data->object;

                    Log::info('pay-details' . '>>>' . $paymentIntent->charges);

                    // Get order detail
                    $order = Orders::where('id', $paymentIntent->metadata->order_id)->first();
                    //   Log::info("Order Details " .  $paymentIntent->charges->data[0]->id);

                    Log::info("Order Details " . $order->unique_order_number . " " . $paymentIntent->metadata->order_id);

                    $user_debited = User::where('stripe_id', $paymentIntent->customer)->first();
                    $PaymentDetailsTransactionHistory = TransactionHistory::create([
                        'customer_id' => $user_debited->id,
                        'payment_details' => "Total cost for order id " . $order->unique_order_number . " debited " . "$" . ($paymentIntent->amount),
                        'order_id' =>  $order->id,
                        'payment_id' =>  $paymentIntent->id,
                        'payment_status' => "Paid",
                        'amount' => "$" . ($paymentIntent->amount),
                        // 'stripe_charge_id' => $paymentIntent->charges->data[0]->id,
                        'transaction_type' => 'debit'
                    ]);

                    // $user_credited = DB::connection('tenant')->table('tenants')->where('stripe_custom_account_id', $paymentIntent->on_behalf_of)->first();

                    $user_credited = DB::table('shopstable.tenants')
                        ->select('id', 'stripe_custom_account_id')
                        ->where('stripe_custom_account_id', '=', 'acct_1LucJz4NsQeEtgNN')
                        ->first();

                    $insert_sql = "INSERT INTO shopstable.tenant_transaction_histories(`tenant_user_id`, `payment_details`, `payment_status`, `amount`,  `stripe_charge_id`,  `transaction_type`,  `created_at`) VALUES (' $user_credited->id', 'Total cost for order id $order->unique_order_number credited $ ($paymentIntent->amount)',  'Paid', '$ ($paymentIntent->amount)', '$paymentIntent->id', 'credit', NOW())";
                    $transactionHistory = DB::insert($insert_sql);

                    // $user_credited = Tenant::where('stripe_custom_account_id', $paymentIntent->on_behalf_of)->first();
                    // $PaymentDetailsTransactionHistory = TenantTransactionHistory::create([
                    //     'tenant_user_id' =>  $user_credited->id,
                    //     'payment_details' => "Total cost for order id " . $order->unique_order_number . " credited " . "$" . ($paymentIntent->amount),
                    //     'payment_status' => "Paid",
                    //     'amount' => "$" . ($paymentIntent->amount),
                    //     'stripe_charge_id' => $paymentIntent->id,

                    //     // 'stripe_charge_id' => $paymentIntent->charges->data[0]->id,
                    //     'transaction_type' => 'credit'
                    // ]);

                    Log::info('payment_intent.created with customer stripe id ' . $paymentIntent->customer);
                    Log::info('Payouts Intent Created for Account: ' . $paymentIntent->stripe_account);
                case 'payment_intent.amount_capturable_updated':
                    $paymentIntent = $event->data->object;


                case 'payment_intent.canceled':
                    $paymentIntent = $event->data->object;
                case 'payment_intent.partially_funded':
                    $paymentIntent = $event->data->object;
                case 'payment_intent.payment_failed':
                    $paymentIntent = $event->data->object;
                case 'payment_intent.processing':
                    $paymentIntent = $event->data->object;

                case 'payment_intent.requires_action':
                    $paymentIntent = $event->data->object;

                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;

                    // ... handle other event types
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
