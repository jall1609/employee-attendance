<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceController\EmployeeService;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    protected $employeeService ;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $data['employees'] = Employee::with('user')->get();
        return view('admin.employee', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-edit-employee');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = $this->employeeService->rules;
        $rule['password'] =  'required|string|min:5';
        $validated_data = $request->validate($rule);
        
        DB::beginTransaction();
        try {
            $create = $this->employeeService->register($validated_data);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('status', 'error')->with('message', $th->getMessage());
        }

        return redirect('/admin/employee')->with('status', 'success')->with('message', "Berhasil create user");

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
