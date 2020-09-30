<?php

namespace App\Http\Controllers\Api;

use App\Bill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Response\BaseResult;
use App\Booking;

class BookingController extends Controller
{
    public function get($id = null)
    {
        if ($id == null) {
            $bookings = Booking::all();
            return BaseResult::withData($bookings);
        } else {
            $booking = Booking::findOrFail($id);
            return BaseResult::withData($booking);
        }
    }
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->IdentityNumber = $request->IdentityNumber;
        $booking->Email = $request->Email;
        $booking->Phone = $request->Phone;
        $booking->CheckInDate = $request->CheckInDate;
        $booking->CheckOutDate = $request->CheckOutDate;
        $booking->Status = $request->Status == "on" ? 1 : 0;
        $booking->FirstName = $request->FirstName;
        $booking->LastName = $request->LastName;
        $bookingMessage = $request->Message;
        $booking->save();
        if ($booking->Status == 1) {
            $bill = new Bill();
            $bill->IdentityNumber = $booking->IdentityNumber;
            $bill->Email = $booking->Email;
            $bill->Phone = $booking->Phone;
            $bill->CheckInDate = $booking->CheckInDate;
            $bill->CheckOutDate = $booking->CheckOutDate;
            $bill->FirstName = $booking->FirstName;
            $bill->LastName = $booking->LastName;
            
        }
        return BaseResult::withData($booking);
    }
    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return $booking;
    }
}
