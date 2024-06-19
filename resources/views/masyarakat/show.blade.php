<!-- resources/views/masyarakat/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Data Masyarakat</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nomor Kartu Keluarga: {{ $masyarakat->nomor_kartu_keluarga }}</h5>
            <p class="card-text">Nama Kepala Keluarga: {{ $masyarakat->nama_kepala_keluarga }}</p>
            <p class="card-text">Nama Istri: {{ $masyarakat->nama_istri }}</p>
            <p class="card-text">Saudara: {{ $masyarakat->saudara }}</p>
            <p class="card-text">Jumlah Anak: {{ $masyarakat->jumlah_anak }}</p>
            <p class="card-text">Biaya Kebutuhan Tiap Bulan: {{ $masyarakat->biaya_kebutuhan_tiap_bulan }}</p>
            <p class="card-text">Biaya Sekolah Anak: {{ $masyarakat->biaya_sekolah_anak }}</p>
            <p class="card-text">Pendapatan Keluarga: {{ $masyarakat->pendapatan_keluarga }}</p>
            <p class="card-text">Status Tempat Tinggal: {{ $masyarakat->status_tempat_tinggal }}</p>
        </div>
    </div>
    <br>
    <a class="btn btn-primary" href="{{ url('/masyarakat') }}">Kembali</a>
</div>
@endsection
