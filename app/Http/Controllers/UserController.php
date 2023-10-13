<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\UserPayments;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        return redirect('user-orders/' . $userId);
    }

    public function addCardDetails(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'card_number' => 'required',
                'expiry_date' => 'required',
                'cvv' => 'required',
                'zip_code' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', ''));
            $user = auth()->user();

            $expiry_date = explode('/', $request->get('expiry_date'));
            $createPaymentToken = $stripe->tokens->create([
                'card' => [
                    'number' => $request->get('number'),
                    'exp_month' => $expiry_date[0],
                    'exp_year' => $expiry_date[1],
                    'cvc' => $request->get('cvv'),
                ],
            ]);

            $create_charge = $stripe->charges->create([
                // 'customer'=> $user->stripe_id,
                'amount' => 50,
                'currency' => 'usd',
                'description' => 'Card Verification',
                'source' => $createPaymentToken->id
            ]);
            $payment_token_id = $createPaymentToken->id;

            $getUserPayment = UserPayments::where('user_id', $user->id)->first();

            if (!$getUserPayment) {
                // creating payment method in stripe
                $response = $stripe->paymentIntents->create([
                    'type' => 'card',
                    'card' => [
                        'number' => $request->get('card_number'),
                        'exp_month' => $expiry_date[0],
                        'exp_year' => $expiry_date[1],
                        'cvc' => $request->get('cvv'),
                    ],
                ]);
                // Creating table values
                $receivemoney = UserPayments::create([
                    'card_number' => "**** **** **** " . $response->card->last4,
                    'expiry_date' => $request->get('expiry_date'),
                    'cvv' => "***",
                    'zip_code' => $request->get('zip_code'),
                    'user_id' => $user->id,
                    'stripe_payment_method_id' => $response->id,
                    'payment_card_token' => $payment_token_id
                ]);

                $stripe->paymentMethods->attach(
                    $response->id,
                    ['customer' =>   $user->stripe_id]
                );

                return response()->json(['message' => 'Success']);
            } else {
                //detach old payment details
                $detachpaymentmethod =  $stripe->paymentMethods->detach($getUserPayment->stripe_payment_method_id, []);

                //create new payment details
                $response = $stripe->paymentMethods->create([
                    'type' => 'card',
                    'card' => [
                        'number' => $request->get('card_number'),
                        'exp_month' => $expiry_date[0],
                        'exp_year' => $expiry_date[1],
                        'cvc' => $request->get('cvv'),
                    ],
                ]);
                $createPaymentToken = $stripe->tokens->create([
                    'card' => [
                        'number' => $request->get('number'),
                        'exp_month' => $expiry_date[0],
                        'exp_year' => $expiry_date[1],
                        'cvc' => $request->get('cvv'),
                    ],
                ]);
                //attch new payment details
                $stripe->paymentMethods->attach(
                    $response->id,
                    ['customer' =>   $user->stripe_id]
                );
                $receivemoney = UserPayments::where('user_id', $user->id)->update([
                    'card_number' => "**** **** **** " . $response->card->last4,
                    'expiry_date' => $request->get('expiry_date'),
                    'cvv' => "***",
                    'zip_code' => $request->get('zip_code'),
                    'stripe_payment_method_id' => $response->id,
                    'payment_card_token' => $payment_token_id
                ]);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }

    public function orderSuccess()
    {
        try {
            // $order = Orders::where('id', $id)->first();
            return view('orders.success');
        } catch (Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile());
            return response()->json(['error' => $e->getMessage() . ' ' . $e->getLine()]);
        }
    }

    public function orderCancel()
    {
        dd('cancel');
    }
}
