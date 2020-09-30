<?php

namespace App\Http\Controllers\Api;

use App\Bill;
use App\Customer;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\Room;
use App\RoomBill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function getBillByDate(Request $request)
    {
        try {
            $from = date('Y-m-d', strtotime($request->SearchFrom));
            $to = date('Y-m-d', strtotime($request->SearchTo));
            $bills = Bill::whereBetween('CheckInDate', [$from, $to])->get();
            foreach ($bills as $bill) {
                $customer = Customer::findOrFail($bill->CUS_ID);
                $roomBills = RoomBill::where(['BIL_ID' => $bill->BIL_ID])->get();
                $bill['customer'] = $customer;
                $bill['roomBills'] = $roomBills;
            }
        } catch (\Exception $e) {
            return BaseResult::error(500, $e->getMessage());
        }
        return BaseResult::withData($bills);
    }
    public function get($id = null)
    {
        if ($id == null) {
            $bills = Bill::all();
            foreach ($bills as $bill) {
                $customer = Customer::findOrFail($bill->CUS_ID);
                $roomBills = RoomBill::where(['BIL_ID' => $bill->BIL_ID])->get();
                $bill['customer'] = $customer;
                $bill['roomBills'] = $roomBills;
            }
            return BaseResult::withData($bills);
        } else {
            $bill = Bill::findOrFail($id);
            $customer = Customer::findOrFail($bill->CUS_ID);
            $roomBills = RoomBill::where(['BIL_ID' => $bill->BIL_ID])->get();
            $bill['customer'] = $customer;
            $bill['roomBills'] = $roomBills;
            return BaseResult::withData($bill);
        }
    }
    public function create(Request $request)
    {
        $customer = new Customer();
        $customer->FirstName = $request->FirstName;
        $customer->LastName = $request->LastName;
        $customer->Phone = $request->Phone;
        $customer->IdentityNumber = $request->IdentityNumber;
        $customer->Email = $request->Email;
        $customer->save();
        $bill = new Bill();
        $bill->CheckInDate = $request->CheckInDate;
        $bill->CheckOutDate = $request->CheckOutDate;
        $bill->CUS_ID = $customer->CUS_ID;
        $bill->save();
        foreach ($request->Rooms as $ROO_ID) {
            $roomBill = new RoomBill();
            $roomBill->ROO_ID = $ROO_ID;
            $roomBill->BIL_ID = $bill->BIL_ID;
            $roomBill->save();
            $room = Room::findOrFail($ROO_ID);
            $room->Status = 1;
            $room->save();
        }
        return BaseResult::withData($bill);
    }
    public function update(Request $request)
    {
        $bill = Bill::findOrFail($request->BIL_ID);
        $bill->CheckInDate = $request->CheckInDate;
        $bill->CheckOutDate = $request->CheckOutDate;
        $roomBills = RoomBill::where(['BIL_ID' => $bill->BIL_ID])->get();
        foreach ($roomBills as $roomBill) {
            $room = Room::findOrFail($roomBill->ROO_ID);
            $room->Status = 1;
            $room->save();
            $roomBill->delete();
        }
        foreach ($request->Rooms as $ROO_ID) {
            $roomBill = new RoomBill();
            $roomBill->ROO_ID = $ROO_ID;
            $roomBill->BIL_ID = $bill->BIL_ID;
            $roomBill->save();
            $room = Room::findOrFail($ROO_ID);
            $room->Status = 0;
            $room->save();
        }
        $bill->save();
        return BaseResult::withData($bill);
    }
    public function delete($id)
    {
        $bill = Bill::findOrFail($id);
        $roomBills = RoomBill::where(['BIL_ID' => $bill->BIL_ID])->get();
        foreach ($roomBills as $roomBill) {
            $roomBill->delete();
            $room = Room::findOrFail($roomBill->ROO_ID);
            $room->Status = 0;
            $room->save();
        }
        $bill->delete();
        return BaseResult::withData($bill);
    }
}
