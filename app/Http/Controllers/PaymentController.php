<?php

namespace App\Http\Controllers;

use App\Address;
use App\Dish;
use App\Order;
use App\OrderedDish;
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
            'phone' => 'required|string|max:15',
    ];
    

    public function prepareCheckout(Request $request){
        $totalIsValid = true;
        $total = 0;
        $request->validate($this->validationArray);
        $data  = $request->all();
        foreach ($data['order'] as $singleDish) {
            $dish = Dish::where('id', $singleDish['id'])->firstOrFail();
            if($dish->price != $singleDish['price']){
                $totalIsValid = false;
            }else{
                $total += $singleDish['price'] * $singleDish['quantity'];
            }
        }
        if($totalIsValid){
            $data['total'] = $total + $data['order'][0]['delivery_price'];
            $newAddress = new Address();
            $newAddress->address = $data['address'];
            $newAddress->city = $data['city'];
            $newAddress->zip_code = $data['zip_code'];
            $newAddress->province = $data['province'];
            $newAddress->save();
    
            $newOrder = new Order();
            $newOrder->restaurant_id = $data['order'][0]['restaurant_id'];
            $newOrder->address_id = $newAddress->id;
            $newOrder->name = $data['name'];
            $newOrder->surname = $data['surname'];
            $newOrder->phone = $data['phone'];
            $newOrder->total = $data['total'];
            $newOrder->payment_status = false;
            $newOrder->payment_provider = 'in attesa';
            $newOrder->save();
            foreach ($data['order'] as $singleDish) {
                $newOrderedDish = new OrderedDish();
                $newOrderedDish->order_id = $newOrder->id;
                $newOrderedDish->dish_id = $singleDish['id'];
                $newOrderedDish->quantity = $singleDish['quantity'];
                $newOrderedDish->save();
            }
    
            return response($content=$data,$status = 200);
        }else{
            return response($content="Errore",$status = 422);
        }
    }

    public function seeCheckout($data){
        return view('checkout');
    }

    public function goCheckout(){
        $order = Order::latest()->first();
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => env('BTREE_MERCHANT_ID'),
            'publicKey' => env('BTREE_PUBLIC_KEY'),
            'privateKey' => env('BTREE_PRIVATE_KEY')
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('orderConfirm', ['token' => $token, 'amount' => $order->total]); 
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
            $order = Order::latest()->first();
            $order->update(['payment_status' => 1, 'payment_provider' => $transaction->creditCardDetails->cardType]);
            return back()->with('success_message', 'Transazione eseguita con successo.');
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return back()->with('error', $result->message);
        }
    }
}
