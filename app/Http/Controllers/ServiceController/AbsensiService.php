<?php

namespace App\Http\Controllers\ServiceController;

use App\Http\Controllers\Controller;
use App\Models\AbsensiLog;
use Illuminate\Http\Request;

class AbsensiService extends Controller
{
    public $rules ;

    public function __construct()
    {
        $this->rules = [
            'status' => 'required|string'
        ];
    }

    public function absensiMasuk($validated_data)
    {
        AbsensiLog::create([
            'tanggal' => now(),
            'employee_id' => auth()->user()->employee->id,
            'status' => $validated_data['status'],
            'jam_masuk' => $validated_data['status'] == 'hadir' ? now() : null,
            'jam_keluar' => $validated_data['jam_keluar'] ?? null ,
            'jam_keterangan' => $validated_data['jam_keterangan'] ?? null ,
        ]);
    }

    public function absensiPulang($validated_data)
    {
        $absensi = auth()->user()->employee->load('absensiHariIni')->absensiHariIni();

        $absensi->update([
            'jam_keluar' => now()
        ]);
    }
}
