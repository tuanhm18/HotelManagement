<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Position;
use App\Response\BaseResult;
use Illuminate\Http\Request;

class EmployeeController extends Controller{
    public function get($id = null) {
        if ($id == null) {
            $employees = Employee::all();
            foreach ($employees as $employee) {
                $position = Position::findOrFail($employee->POS_ID);
                $employee['position'] = $position;
            }
            return BaseResult::withData($employees);
        } else {
            $employee = Employee::findOrFail($id);
            $position = Position::findOrFail($employee->POS_ID);
            $employee['position'] = $position;
            return BaseResult::withData($employee);
        }
    }

}
