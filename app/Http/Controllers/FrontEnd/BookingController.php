<?php

namespace App\Http\Controllers\FrontEnd;

use App\Booking;
use App\BookingRoom;
use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;

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
        $booking->CheckInDate =date('Y-m-d', strtotime($request->CheckInDate));
        $booking->CheckOutDate = date('Y-m-d', strtotime($request->CheckOutDate));
        $booking->Message = $request->Message;
        $booking->Status = 0;
        $booking->CreatedDate = Carbon::now();
        try {
            $booking->save();
            foreach ($request->Rooms as $room) {
                $bookingRoom = new BookingRoom();
                $bookingRoom->BOO_ID = $booking->BOO_ID;
                $bookingRoom->ROO_ID = $room;
                $bookingRoom->save();
            }
            Session::flash('success', true);
            event(new MyEvent($booking->BOO_ID, "Has new Booking"));
            return Redirect::back();
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return Redirect::back();
        }
    }
}
