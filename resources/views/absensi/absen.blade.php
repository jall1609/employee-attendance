@extends('absensi.main')

@section('head')
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, #4CAF50, #81C784);
    }
    .cont {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 90vh;
    }
    .container {
        display: flex;
        justify-content: center;
        gap: 100px;
    }
    .left, .right {
        width: 500px;
        height: 500px;
        display: flex;
        align-items: center;
        color: black;
        justify-content: center;
        font-size: 18px;
        background-color: white;
        border-radius: 50px;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<h2 class="text-center mt-5"> {{  ($absensi_hari_ini->status ?? null ) == 'izin' ||  (  ($absensi_hari_ini->status ?? null) == 'hadir' && isset($absensi_hari_ini->jam_keluar)  ) ? 'Terima Kasih Sudah Mengisi Form Absen Hari Ini' : 'FORM ABSENSI'    }}    </h2>
<div class="cont">
    <div class="container">
        @if(empty($absensi_hari_ini))
            <form action="{{ url('/employee/absensi') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="status" value="hadir">
                <button type="submit" class="left">Hadir</button>
            </form>
            <form action="{{ url('employee/absensi') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="status" value="izin">
                <button type="submit" class="right">Ajukan Izin</button>
            </form>
        @elseif(($absensi_hari_ini->status ?? null) == 'hadir' && empty($absensi_hari_ini->jam_keluar) )
            <form action="{{ url('employee/absensi') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="status" value="pulang">
                <button type="submit" class="right">Absensi Pulang</button>
            </form>
        @else
        @endif
        <form action="{{ url('auth/logout') }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="right">Logout</button>
            </form>
    </div>
</div>
@endsection