@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Pencarian Data Penerima KMS</h1>
    <form action="{{ url('/pencarian-kms') }}" method="GET" class="mb-3">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nomor_kartu_keluarga" class="form-label">Nomor Kartu Keluarga</label>
                <input type="text" class="form-control" id="nomor_kartu_keluarga" name="nomor_kartu_keluarga" placeholder="Masukkan Nomor Kartu Keluarga" value="{{ request('nomor_kartu_keluarga') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cari Data</button>
    </form>

    @if(isset($results) && $results->isNotEmpty())
    <div class="mt-4">
        <h2>Hasil Pencarian</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor Kartu Keluarga</th>
                    <th>Nama Kepala Keluarga</th>
                    <th>Nama Istri</th>
                    <th>Jumlah Anak</th>
                    <th>Biaya Kebutuhan</th>
                    <th>Biaya Sekolah Anak</th>
                    <th>Pendapatan Keluarga</th>
                    <th>Tempat Tinggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    @if($result->masyarakat)
                    <tr>
                        <td>{{ $result->masyarakat->nomor_kartu_keluarga }}</td>
                        <td>{{ $result->masyarakat->nama_kepala_keluarga }}</td>
                        <td>{{ $result->masyarakat->nama_istri }}</td>
                        <td>{{ $result->masyarakat->jumlah_anak }}</td>
                        <td>{{ $result->masyarakat->biaya_kebutuhan_tiap_bulan }}</td>
                        <td>{{ $result->masyarakat->biaya_sekolah_anak }}</td>
                        <td>{{ $result->masyarakat->pendapatan_keluarga }}</td>
                        <td>{{ $result->masyarakat->status_tempat_tinggal }}</td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="8">Data masyarakat tidak ditemukan</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    @elseif(isset($results))
    <div class="mt-4">
        <h2>Hasil Pencarian</h2>
        <p>Tidak ada data penerima KMS yang ditemukan.</p>
    </div>
    @endif
</div>
@endsection
