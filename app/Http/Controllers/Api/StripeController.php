<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\DealOwner;
use App\Models\Payment;
use App\Models\Deal;
use Stripe\Webhook;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function checkout (Request $request) {
        try { 
            $request->validate([
                'amount' => 'required',
            ],
            [
                'amount.required' => 'Please provide amount',
            ]);

            $user = $request->user();

            Stripe::setApiKey(config('stripe.sk'));

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items'  => [
                    [
                        'price_data' => [
                            'currency'     => 'usd',
                            'product_data' => [
                                'name' => $user->first_name.' '.$user->last_name,
                            ],
                            // this unit is in cents
                            'unit_amount'  => $request->amount,
                        ],
                        'quantity'   => 1,
                    ],
                ],
                'mode'        => 'payment',
                'success_url' => 'http://localhost:5173/do/payment/success',
                'cancel_url'  => 'http://localhost:5173/do/payment/cancel',
            ]);
            // dd($session->id);
            $payment = Payment::create([
                'amount' =>$request->amount,
                'deal_owner_id' => $user->id,
                'session_id' => $session->id,
                'status' => 'pending'
            ]);

            return response()->json(['url' => $session->url]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not make payment',
                'error' => $exception->message
            ],500);
        }
    }

    public function recordPayment (Request $request) {
        try {
            $request->validate([
                'amount' => 'required',
            ],
            [
                'amount.required' => 'Please provide amount',
            ]);
            $payment = Payment::create([
                'amount' =>$request->amount,
                'deal_owner_id' => $user->id,
            ]);
            return response()->json([
                'message' => 'Recorded payment',
                'data' => $payment
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not record payment',
                'error' => $exception->message
            ],500);
        }
    }

    public function webhook() {
        $endpoint_secret = 'whsec_c73b10c13a21879f39ed0df8a825c1a3129228072f6d95f10b12c58bcde09b2b';
        // env('STRIPE_WEBHOOK_KEY');
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // invalid payload
            return response('', 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // invalid signature
            return response('', 400);
        }

        // handle event
        switch($event->type) {
            case 'checkout.session.completed': 
                // change the recorded payment from pending to paid
                $session = $event->data->object;
                $payment = Payment::where('session_id', $session->id)->first();
                if($payment && $payment->status === 'pending') {
                    $payment->status = 'paid';
                    $payment->save();
                }               
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }

    // public function makePaymentIntent (Request $request) {
    //     $stripe = new \Stripe\StripeClient(config('stripe.sk'));
    //     // Stripe::setApiKey(config('stripe.sk'));

    //     try {

    //         // Create a PaymentIntent with amount and currency
    //         $paymentIntent = $stripe->paymentIntents->create([
    //             'amount' => $request->amount,
    //             'currency' => 'usd',
    //             'automatic_payment_methods' => [
    //                 'enabled' => true,
    //             ],
    //         ]);
    //         return response()->json(['clientSecret' => $paymentIntent->client_secret]);
    //     } catch (Exception $exception) {
    //         return response()->json([
    //             'message' => 'Could not make payment',
    //             'error' => $exception->getMessage()
    //         ],500);
    //     }
    // }

    public function saveCardDetails(Request $request)
    {
        // Get payment method ID from the request
        $paymentMethodId = $request->input('paymentMethodId');

        // Set Stripe API key
        Stripe::setApiKey(config('stripe.sk'));

        try {
            // Retrieve payment method details from Stripe
            $paymentMethod = PaymentMethod::retrieve($paymentMethodId);
            // Save payment method details to your database
            dd($paymentMethod->card);
            $this->saveCardDetailsToDatabase($paymentMethod->card);
            return response()->json(['message' => 'Card details saved successfully'], 200);
        } catch (\Exception $e) {
            // Handle error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function saveCardDetailsToDatabase($card)
    {
        // Implement your logic to save card details to your database
        // Example:
        // $card->brand - Card brand (e.g., Visa, Mastercard)
        // $card->last4 - Last 4 digits of the card number
        // $card->exp_month - Expiration month
        // $card->exp_year - Expiration year
        // Save these details to your database table
    }

    public function createSetupIntent(Request $request) {
        try {
            $user = $request->user();
            $stripe = new \Stripe\StripeClient(config('stripe.sk'));
            $customer = $stripe->customers->create([]);
            
            // store customer id here
            $dealOwner = DealOwner::where('id', $user->id)->first();
            $dealOwner->payment_customer_id = $customer->id;
            $dealOwner->payment_saved_status = 'processing';
            $dealOwner->save();
            // if($dealOwner->payment_customer_id === null){
            // }

            $intent = $stripe->setupIntents->create([
                'customer' => $customer->id,
                'automatic_payment_methods' => ['enabled' => true],
            ]);

            

            // dd($intensetupIntentt->payment_method_configuration_details->id);

            return response()->json([
                'client_secret' => $intent->client_secret
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->message
            ]);
        }
    }

    public function cardSaved (Request $request) {
        try {
            
            $user = $request->user();

            $dealOwner = DealOwner::where('id', $user->id)->first();
            $dealOwner->payment_saved_status = 'saved';
            $dealOwner->save();
            return response()->json([
                'message' => 'card saved successfully'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->message
            ]);
        }
    }

    public function retrieveSavedCards (Request $request) {
        // this not working, just showing payment methods which are empty for now
        // need to check how to retrieve saved cards 
        try {
            $user = $request->user();
            $stripe = new \Stripe\StripeClient(config('stripe.sk'));
            $dealOwner = DealOwner::where('id', $user->id)->first();
            $cards = $stripe->paymentMethods->all([
            'customer' => $dealOwner->payment_customer_id,
            'type' => 'card',
            ]);
            return response()->json([
                'cards' => $cards
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->message
            ]);
        }
    }

    public function chargeSavedCard (Request $request) {
        $user = $request->user();
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        try {
            $dealOwner = DealOwner::where('id', $user->id)->first();
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => 1099,
                'currency' => 'usd',
                // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
                'automatic_payment_methods' => ['enabled' => true],
                'customer' => $dealOwner->payment_customer_id,
                'payment_method' => 'pm_1PByC6AuvBrM62EaOAknMuWn',
                'return_url' => 'http://localhost:5173/charged-saved-card-successfully',
                'off_session' => true,
                'confirm' => true,
            ]);
            return response()->json([
                'message' =>'Charged card successfully',
                'payment_intent_id' => $paymentIntent->id,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            // Error code will be authentication_required if authentication is needed
            return response()->json([
                'error_code' =>'Error code is:' . $e->getError()->code,
                'payment_intent_id' => $payment_intent_id = $e->getError()->payment_intent->id,
            ]);
        }
    }

    private function makePaymentIntent ($discount, $customer_id) {
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        try {
            $cards = $stripe->paymentMethods->all([
                'customer' => $customer_id,
                'type' => 'card',
            ]);

            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $discount*100,
                'currency' => 'usd',
                'automatic_payment_methods' => ['enabled' => true],
                'customer' => $customer_id,
                'payment_method' => $cards->data[0]->id,
                'return_url' => 'http://localhost:5173/charged-saved-card-successfully',
                'off_session' => true,
                'confirm' => true,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            // Error code will be authentication_required if authentication is needed
            return response()->json([
                'error_code' =>'Error code is:' . $e->getError()->code,
                'payment_intent_id' => $payment_intent_id = $e->getError()->payment_intent->id,
            ]);
        }
    }

    public function chargeHalfDiscountOnCheckout (Request $request, $unique_deal_id) {
        $user = $request->user();
        $dealOwner = DealOwner::where('id', $user->id)->first();
        if($dealOwner->payment_customer_id && $dealOwner->payment_saved_status === 'saved') {
            $deal = Deal::where('unique_deal_identifier', $unique_deal_id)->first();
            // calculate amounts
            // I need to get the full amount and multiply by the discount
            $discount = ($deal->original_price * ($deal->discount/100)) * $request->quantity;
            $this->makePaymentIntent($discount, $dealOwner->payment_customer_id);

            // save to payments table
            $payment = new Payment();
            $payment->deal_owner_id = $dealOwner->id;
            $payment->quantity = $request->quantity;
            $payment->deal_id = $deal->id;
            $payment->amount = $discount;
            $payment->save();
            
            return response()->json([
                'message' =>'Charged card successfully',
                'amount' => $discount,
                'payment' => $payment
            ]);
        } else {
            return response()->json([ 
                'message' =>'Payment details missing ',
            ]);
        }
    }
}
