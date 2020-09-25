<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Position;
use App\Response\BaseResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function validEmployeeIdentity($identity)
    {
        $employee = Employee::where(['IdentityNumber' => $identity])->first();
        if ($employee) return response()->json([
            'error' => false,
            'message' => 'This identity has been taken'
        ]);
        else {
            return response()->json([
                'error' => true,
                'IdentityNumber' => $identity,
                "message" => 'Valid Identity'
            ]);
        }
    }
    public function get($id = null)
    {
        if ($id == null) {
            $employees = Employee::all();
            foreach ($employees as $employee) {
                $position = Position::findOrFail($employee->POS_ID);
                $employee['Position'] = $position->Name;
            }
            return BaseResult::withData($employees);
        } else {
            $employee = Employee::findOrFail($id);
            $position = Position::findOrFail($employee->POS_ID);
            $employee['Position'] = $position->Name;
            return BaseResult::withData($employee);
        }
    }

    public function create(Request $request)
    {
        $employee = new Employee();
        $employee->Name = $request->Name;
        $employee->IdentityNumber = $request->IdentityNumber;
        $employee->Phone = $request->Phone;
        $employee->Address = $request->Address;
        $employee->Email = $request->Email;
        $employee->POS_ID = $request->POS_ID;
        try {
            $employee->save();
        } catch (\Exception $e) {
            return BaseResult::error(500, $e->getMessage());
        }
        return BaseResult::withData($employee);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        if($employee){
            $employee = new Employee();
            $employee->Name = $request->Name;
            $employee->IdentityNumber = $request->IdentityNumber;
            $employee->Phone = $request->Phone;
            $employee->Address = $request->Address;
            $employee->Email = $request->Email;
            $employee->POS_ID = $request->POS_ID;
            $employee['UpdatedDate'] = Carbon::now();
            $employee->save();
        } else {
            return BaseResult::error(404, "Not found data");
        }
        return BaseResult::withData($employee);
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return $employee;
    }
}
