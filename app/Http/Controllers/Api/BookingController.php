<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Response\BaseResult;
use App\Booking;

class BookingController extends Controller
{
    public function get($id = null) {
        if ($id == null) {
            $bookings = Booking::all();
            return BaseResult::withData($bookings);
        } else {
            $booking= Booking::findOrFail($id);
            return BaseResult::withData($booking);
        }
    }
    public function update(Request $request, $id){
        $booking = Booking::findOrFail($id);
        $booking->IdentityNumber = $request->IdentityNumber;
        $booking->Email = $request->Email;
        $booking->Phone = $request->Phone;
        $booking->CheckInDate = $request->CheckInDate;
        $booking->CheckOutDate = $request->CheckOutDate;
        $booking->Status = $request->Status == "on" ? 1 : 0;
        $booking->save();
        return BaseResult::withData($booking);
    }
    public function delete($id) {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return $booking;
    }
}
