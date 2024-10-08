<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index(){
        
        $bookings = Booking::all();

        return response()->json( $bookings);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date' => 'required',
            'service' => 'required',
        ]);

        Booking::create($request->all());

        return response()->json(['message' => 'Booking successfully'], 201);
    }

    public function search(Request $request){
        $request->validate([
            'phone' => 'required',
        ]);

        $booking = Booking::where('phone', $request->phone)->first();

        if($booking){
            return response()->json($booking);
        }else{
            return response()->json(['message' => 'Booking not found'], 404);
        }
    }

    public function updateStatus($id, $action)
{
    $booking = Booking::find($id);
    
    if (!$booking) {
        return response()->json(['message' => 'Booking not found'], 404);
    }

    if ($action !== 'accepted' && $action !== 'declined') {
        return response()->json(['message' => 'Invalid action'], 400);
    }

    $booking->status = $action;
    $booking->save();

    return response()->json(['message' => 'Booking status updated successfully'], 200);
}

}
