<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceController\AbsensiService;
use App\Models\AbsensiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    protected $absensiService ;

    public function __construct(AbsensiService $absensiService)
    {
        $this->absensiService = $absensiService;
    }

    public function index()
    {
        return view('absensi.index');
    }

    public function absensiForm()
    {
        $data['absensi_hari_ini'] = auth()->user()->employee->load('absensiHariIni')->absensiHariIni;
        return view('absensi.absen', $data);
    }

    public function absensi(Request $request)
    {
        $rules = $this->absensiService->rules;
        $validatedData = $request->validate($rules);

        DB::beginTransaction();
        try {
            if($validatedData['status'] == 'pulang') {
                $create = $this->absensiService->absensiPulang($validatedData);
            } else {
                $create = $this->absensiService->absensiMasuk($validatedData);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('status', 'error')->with('message', $th->getMessage());
        }

        return redirect('/employee/absensi')->with('status', 'success')->with('message', "Berhasil Absensi");
    }
}
