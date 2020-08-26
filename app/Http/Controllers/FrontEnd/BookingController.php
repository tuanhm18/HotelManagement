<?php

namespace App\Http\Controllers\FrontEnd;

use App\Booking;
use App\BookingRoom;
use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BookingController extends Controller
{   
    public function view() {
        return view('frontend.booking');
    }
    public function create(Request $request) {
        $booking = new Booking();
        $booking->Phone = $request->Phone;
        $booking->IdentityNumber = $request->IdentityNumber;
        $booking->FirstName = $request->FirstName;
        $booking->LastName = $request->LastName;
        $booking->Status = 0;
        $booking->Email = $request->Email;
        $booking->CheckInDate = $request->CheckInDate;
        $booking->CheckOutDate = $request->CheckOutDate;
        $booking->Message = $request->Message;
        $booking->CreatedDate = Carbon::now();
        $booking->save();
        foreach ($request->Rooms as $room) {
            $bookingRoom = new BookingRoom();
            $bookingRoom->BOO_ID = $booking->BOO_ID;
            $bookingRoom->ROO_ID = $room;
            $bookingRoom->save();
        }
        event(new MyEvent("Has new Booking"));
        return redirect()->back()->with("success", true);
    }
}
