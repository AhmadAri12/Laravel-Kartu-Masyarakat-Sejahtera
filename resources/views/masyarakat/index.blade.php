<!-- resources/views/masyarakat/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Masyarakat</h1>
    <form action="{{ url('/masyarakat') }}" method="GET" class="mb-3">
        <input type="text" name="search" placeholder="Cari Nama Kepala Keluarga" value="{{ request('search') }}" class="form-control">
        <br>
        <a href="{{ route('masyarakat.create') }}" class="btn btn-primary">Tambah Data Masyarakat</a>
        <a href="{{ route('masyarakat.report') }}" class="btn btn-danger">Cetak Data</a>
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($masyarakats as $masyarakat)
            <tr>
                <td>{{ $masyarakat->nomor_kartu_keluarga }}</td>
                <td>{{ $masyarakat->nama_kepala_keluarga }}</td>
                <td>{{ $masyarakat->nama_istri }}</td>
                <td>{{ $masyarakat->jumlah_anak }}</td>
                <td>{{ $masyarakat->biaya_kebutuhan_tiap_bulan }}</td>
                <td>{{ $masyarakat->biaya_sekolah_anak }}</td>
                <td>{{ $masyarakat->pendapatan_keluarga }}</td>
                <td>{{ $masyarakat->status_tempat_tinggal }}</td>
                <td>
                    <a href="{{ route('masyarakat.show', $masyarakat->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('masyarakat.edit', $masyarakat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('masyarakat.delete', $masyarakat->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $masyarakats->links() }}
</div>
@endsection
