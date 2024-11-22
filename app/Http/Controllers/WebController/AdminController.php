<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceController\AdminService;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    protected $adminService ;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = $this->adminService->rules;
        $rules['password'] =  'required|string|min:5';
        $validator = Validator::make($request->all(), $rules );
        
        if ($validator->fails()) {
            return sendResponse(400, $validator->errors(), 'Bad Request');
        }

        $validatedData = $validator->validated();

        DB::beginTransaction();
        try {
            $create = $this->adminService->register($validatedData);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('status', 'error')->with('message', $th->getMessage());
        }

        return redirect('/admin')->with('status', 'success')->with('message', "Berhasil create user");
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function login()
    {
        return view('admin.login');
    }
}
