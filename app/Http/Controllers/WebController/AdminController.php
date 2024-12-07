<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceController\AbsensiService;
use App\Http\Controllers\ServiceController\AdminService;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    protected $adminService ;
    protected $absensiService ;

    public function __construct(AdminService $adminService, AbsensiService $absensiService)
    {
        $this->adminService = $adminService;
        $this->absensiService = $absensiService;
    }

    public function index()
    {
        $data['data_absensi'] = $this->absensiService->getAbsensi(new Request([
            'tanggal' => now()->format('Y-m-d')
        ]));
        return view('admin.index', $data);
    }

    public function attendance()
    {
        $data['data_absensi'] = $this->absensiService->getAbsensi();
        return view('admin.absensi', $data);
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
        $validatedData = $request->validate($rules);

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
