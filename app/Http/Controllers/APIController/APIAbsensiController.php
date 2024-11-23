<?php

namespace App\Http\Controllers\APIController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceController\AbsensiService;
use Illuminate\Http\Request;

class APIAbsensiController extends Controller
{
    protected $absensiService ;

    public function __construct(AbsensiService $absensiService)
    {
        $this->absensiService = $absensiService;
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
            return sendResponse( 500, $th->getMessage(), 'Internal Server Error' );
        }

        return sendResponse(201, $create, 'Berhasil Absensi!');
    }

    public function getAbsensi(Request $request)
    {
        $rules = $this->absensiService->rules;

        try {
            $absensi = $this->absensiService->getAbsensi($request);
        } catch (\Throwable $th) {
            return sendResponse( 500, $th->getMessage(), 'Internal Server Error' );
        }

        return sendResponse(201, $absensi, 'Berhasil Get Absensi!');
    }
}
