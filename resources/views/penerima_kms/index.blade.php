<!-- resources/views/penerima_kms/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Penerima KMS (Kartu Masyarakat Sejahtera)</h1>
    <form action="{{ url('/penerima-kms') }}" method="GET" class="mb-3">
        <a href="{{ route('penerima-kms.report') }}" class="btn btn-danger">Cetak Data</a>
    </form>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nomor Kartu Keluarga</th>
                <th>Nama Kepala Keluarga</th>
                <th>Jumlah Saudara</th>
                <th>Jumlah Anak</th>
                <th>Biaya Kebutuhan/Bulan</th>
                <th>Biaya Sekolah Anak</th>
                <th>Pendapatan Keluarga</th>
                <th>Status Tempat Tinggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penerimaKms as $penerima)
            <tr>
                <td>{{ $penerima->masyarakat->nomor_kartu_keluarga }}</td>
                <td>{{ $penerima->masyarakat->nama_kepala_keluarga }}</td>
                <td>{{ $penerima->masyarakat->saudara }}</td>
                <td>{{ $penerima->masyarakat->jumlah_anak }}</td>
                <td>{{ $penerima->masyarakat->biaya_kebutuhan_tiap_bulan }}</td>
                <td>{{ $penerima->masyarakat->biaya_sekolah_anak }}</td>
                <td>{{ $penerima->masyarakat->pendapatan_keluarga }}</td>
                <td>{{ $penerima->masyarakat->status_tempat_tinggal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
