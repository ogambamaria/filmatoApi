<?php

namespace App\Http\Controllers;
use App\Payment;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'phone'=>'required',
            'amount'=>'required'
        ]);

        if($validator->fails()){
            return array(
                'error' => true,
                'message' => $validator->errors()->all()
            );
        }

        $payment = new Payment;
        $payment->phone = $request->input('phone');
        $payment->amount = $request->input('amount');
        $payment->save();

        return array('error'=>false, 'payment'=>$payment);
    }
}
