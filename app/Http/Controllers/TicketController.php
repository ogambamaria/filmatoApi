<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Ticket;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'email' => 'required',
            'movie' => 'required',
            'date' => 'required',
            'time' => 'required',
            'cinema' => 'required',
            'seats' => 'required',
        ];

        $customMessages = [
            'required' => 'Please fill in the attribute :attribute'
        ];
        $this->validate($request, $rules, $customMessages);

        try {
            $email = $request->input('email');
            $movie = $request->input('movie');
            $date = $request->input('date');
            $time = $request->input('time');
            $cinema = $request->input('cinema');
            $seats = $request->input('seats');

            $save = Ticket::create([
                'email'=> $email,
                'movie'=> $movie,
                'date'=> $date,
                'time'=> $time,
                'cinema'=> $cinema,
                'seats'=> $seats,
                'api_token'=> ''
            ]);

            $res['status'] = true;
            $res['message'] = 'Booking successful!';
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
