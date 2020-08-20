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
    public function validateEmployee(Request $request)
    {
        if ($request->EMP_ID != 0) {
            $employee = Employee::findOrFail($request->EMP_ID);
            if ($employee) {
                if ($employee->IdentityNumber == $request->IdentityNumber) {
                    return  response()->json([
                        'error' => 0,
                        'data' => $request->IdentityNumber,
                        'message' => ''
                    ]);
                }
            }
        }
        $rules = array(
            'IdentityNumber' => 'unique:Employees,IdentityNumber'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'validator' => $validator,
                'error' => 1,
                'data' => $request->IdentityNumber,
                'message' => 'This identity has been used'
            ]);
        } else {
            return response()->json([
                'validator' => $validator,
                'error' => 0,
                'data' => $request->IdentityNumber,
                'message' => 'This identity has not been used'
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
        $employee['CreatedDate'] = Carbon::now();
        $employee->save();
        return $employee;
    }

    public function update(Request $request)
    {
        $employee = Employee::findOrFail($request->EMP_ID);
        $employee = new Employee();
        $employee->Name = $request->Name;
        $employee->IdentityNumber = $request->IdentityNumber;
        $employee->Phone = $request->Phone;
        $employee->Address = $request->Address;
        $employee->Email = $request->Email;
        $employee->POS_ID = $request->POS_ID;
        $employee['UpdatedDate'] = Carbon::now();
        $employee->save();
        return $employee;
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return $employee;
    }
}
