<?php

namespace App\Http\Controllers;

use Braintree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    private $validationArray = [
        'name' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'zip_code' => 'required|string|max:5',
            'surname' =>  'required|string|max:100',
            'city' => 'required|string|max:60',
            'province' => 'required|string|max:2',
    ];
    

    public function prepareCheckout(Request $request){
        $request->validate($this->validationArray);
        $data  = $request->all();
        return response($content=$data,$status = 200);

        /* return $this->seeCheckout($data); */
    }

    public function seeCheckout($data){
        var_dump($data);
        return view('checkout');
    }

    public function goCheckout(){
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => env('BTREE_MERCHANT_ID'),
            'publicKey' => env('BTREE_PUBLIC_KEY'),
            'privateKey' => env('BTREE_PRIVATE_KEY')
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('orderConfirm', ['token' => $token]); 
    }

    public function doCheckout(Request $request){
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => env('BTREE_MERCHANT_ID'),
            'publicKey' => env('BTREE_PUBLIC_KEY'),
            'privateKey' => env('BTREE_PRIVATE_KEY')
        ]);
    
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Tony',
                'lastName' => 'Stark',
                'email' => 'tony@avengers.com',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
    
    
        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);
    
            return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    }
}
