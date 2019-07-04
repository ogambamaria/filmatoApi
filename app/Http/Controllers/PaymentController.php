<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Payment;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'phone' => 'required',
            'amount' => 'required',
        ];

        $customMessages = [
            'required' => 'Please fill in the attribute :attribute'
        ];
        $this->validate($request, $rules, $customMessages);

        try {
            $phone = $request->input('phone');
            $amount = $request->input('amount');

            $save = Payment::create([
                'phone'=> $phone,
                'amount'=> $amount,
            ]);

            $res['status'] = true;
            $res['message'] = 'Payment Successful!';
            return response($res, 200);
        }

        catch (QueryException $ex)
        {
            $res['status'] = false;
            $res['message'] = $ex->getMessage();
            return response($res, 500);
        }

    }
}
