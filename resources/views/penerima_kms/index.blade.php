<!-- resources/views/penerima_kms/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Penerima Kartu Masyarakat Sejahtera (KMS)</h1>
    <form action="{{ url('/penerima-kms') }}" method="GET" class="mb-3">
    <a href="{{ route('penerima_kms.report') }}" class="btn btn-danger">Cetak Data</a>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nomor KK</th>
                <th>Nama Kepala</th>
                <th>Nama Istri</th>
                <th>Jumlah Anak</th>
                <th>Biaya Kebutuhan</th>
                <th>Biaya Sekolah Anak</th>
                <th>Pendapatan Keluarga</th>
                <th>Tempat Tinggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penerimaKms as $penerima)
            <tr>
                <td>{{ $penerima->masyarakat->nomor_kartu_keluarga }}</td>
                <td>{{ $penerima->masyarakat->nama_kepala_keluarga }}</td>
                <td>{{ $penerima->masyarakat->nama_istri }}</td>
                <td>{{ $penerima->masyarakat->jumlah_anak }}</td>
                <td>{{ $penerima->masyarakat->biaya_kebutuhan_tiap_bulan }}</td>
                <td>{{ $penerima->masyarakat->biaya_sekolah_anak }}</td>
                <td>{{ $penerima->masyarakat->pendapatan_keluarga }}</td>
                <td>{{ $penerima->masyarakat->status_tempat_tinggal }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data penerima KMS.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
