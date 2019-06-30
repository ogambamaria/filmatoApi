<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'cinema'=>'required',
            'date'=>'required',
            'time'=>'required',
            'seat'=>'required'
        ]);

        if($validator->fails()){
            return array(
                'error' => true,
                'message' => $validator->errors()->all()
            );
        }

        $ticket = new Ticket;
        $ticket->cinema = $request->input('cinema');
        $ticket->date = $request->input('date');
        $ticket->time = $request->input('time');
        $ticket->seat = $request->input('seat');
        $ticket->save();

        return array('error'=>false, 'ticket'=>$ticket);
    }
}
