@extends('admin.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3 d-inline-block">Daftar Hadir</h6>
            </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Karyawan</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                        </thead>
                        <tbody>
                            @foreach($data_absensi as $absen)
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$absen->tanggal}}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{$absen->employee->name}}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-{{ $absen->status == 'hadir' ? 'success' : 'secondary' }}">{{$absen->status}}</span>
                                </td>
                                <td class="align-middle text-center">
                                    @if($absen->status == 'hadir')
                                        <span class="text-secondary text-xs font-weight-bold d-block"> Masuk : {{ $absen->jam_masuk }} </span>
                                        <span class="text-secondary text-xs font-weight-bold"> Keluar :{{ $absen->jam_keluar }}  </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection