<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class DonateController extends Controller
{

    public function index(Request $request)
    {
        return view('donate', [
            'amount' => $request->amount * 100,
            'description' => $request->description
        ]);
    }

    public function submit(Request $request)
    {
        try {
            $this->doPayment($request->stripeToken, $request->stripeEmail, $request->amount);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return view('success');
    }

    protected function doPayment($token, $email, $amount)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $customer = Customer::create(array(
            'email' => $email,
            'card'  => $token
        ));

        $charge = Charge::create(array(
            'customer' => $customer->id,
            'amount'   => $amount,
            'currency' => 'usd'
        ));

    }
}