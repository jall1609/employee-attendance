<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceController\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIEmployeeController extends Controller
{
    protected $employeeService ;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function createEmployee(Request $request)
    {
        $rule = $this->employeeService->rules;
        $rule['password'] =  'required|string|min:5';

        $validated_data =  Validator::make($request->all(), $rule);

        if ($validated_data->fails()) {
            return sendResponse(400, $validated_data->errors(), 'Bad Request');
        }

        $validated_data = $validated_data->validated();
        
        try {
            $create = $this->employeeService->register($validated_data);
            sendResponse(201, $create, 'Create Employee Success!');
        } catch (\Throwable $th) {
            return sendResponse( 500, $th->getMessage(), 'Internal Server Error' );
        }
    }
}
