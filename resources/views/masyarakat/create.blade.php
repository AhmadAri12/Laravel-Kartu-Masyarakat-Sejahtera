<!-- resources/views/masyarakat/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Data Masyarakat</h1>
    <form action="{{ route('masyarakat.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nomor_kartu_keluarga" class="form-label">Nomor KK</label>
            <input type="text" class="form-control" id="nomor_kartu_keluarga" name="nomor_kartu_keluarga" required>
        </div>
        <div class="mb-3">
            <label for="nama_kepala_keluarga" class="form-label">Kepala Keluarga</label>
            <input type="text" class="form-control" id="nama_kepala_keluarga" name="nama_kepala_keluarga" required>
        </div>
        <div class="mb-3">
            <label for="nama_istri" class="form-label">Istri</label>
            <input type="text" class="form-control" id="nama_istri" name="nama_istri">
        </div>
        <div class="mb-3">
            <label for="saudara" class="form-label">Saudara</label>
            <input type="number" class="form-control" id="saudara" name="saudara" required>
        </div>
        <div class="mb-3">
            <label for="jumlah_anak" class="form-label">Anak</label>
            <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" required>
        </div>
        <div class="mb-3">
            <label for="biaya_kebutuhan_tiap_bulan" class="form-label">Biaya Kebutuhan Tiap Bulan</label>
            <input type="number" class="form-control" id="biaya_kebutuhan_tiap_bulan" name="biaya_kebutuhan_tiap_bulan" required>
        </div>
        <div class="mb-3">
            <label for="biaya_sekolah_anak" class="form-label">Biaya Sekolah Anak</label>
            <input type="number" class="form-control" id="biaya_sekolah_anak" name="biaya_sekolah_anak">
        </div>
        <div class="mb-3">
            <label for="pendapatan_keluarga" class="form-label">Pendapatan Keluarga</label>
            <input type="number" class="form-control" id="pendapatan_keluarga" name="pendapatan_keluarga" required>
        </div>
        <div class="mb-3">
            <label for="status_tempat_tinggal" class="form-label">Tempat Tinggal</label>
            <select class="form-control" id="status_tempat_tinggal" name="status_tempat_tinggal" required>
                <option value="">Pilih Status Tempat Tinggal</option>
                <option value="Tetap">Tetap</option>
                <option value="Ngontrak">Ngontrak</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
