<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceController\AbsensiService;
use App\Http\Controllers\ServiceController\EmployeeService;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class APIEmployeeController extends Controller
{
    protected $employeeService ;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function store(Request $request)
    {
        $rule = $this->employeeService->rules;
        $rule['password'] =  'required|string|min:5';

        $validated_data =  Validator::make($request->all(), $rule);

        if ($validated_data->fails()) {
            return sendResponse(400, $validated_data->errors(), 'Bad Request');
        }

        $validated_data = $validated_data->validated();
        
        DB::beginTransaction();
        try {
            $create = $this->employeeService->register($validated_data);
            DB::commit();
            return sendResponse(201, $create, 'Create Employee Success!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return sendResponse( 500, $th->getMessage(), 'Internal Server Error' );
        }
    }

    public function update(Request $request, Employee $employee)
    {
        DB::beginTransaction();
        try {
            $create = $this->employeeService->update($request->all(), $employee);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return sendResponse( 500, $th->getMessage(), 'Internal Server Error' );
        }
        return sendResponse(201, $create, 'Update Employee Success!');
    }

    public function destroy(Employee $employee)
    {
        DB::beginTransaction();
        try {
            $create = $this->employeeService->delete( $employee);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return sendResponse( 500, $th->getMessage(), 'Internal Server Error' );
        }
        return sendResponse(201, $create, 'Delete Employee Success!');
    }
}
