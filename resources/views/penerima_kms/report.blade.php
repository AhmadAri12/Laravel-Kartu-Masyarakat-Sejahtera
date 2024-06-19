<!-- resources/views/penerima_kms/report.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penerima KMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
            word-wrap: break-word;
        }
        th {
            background-color: #f2f2f2;
        }
        .nowrap {
            white-space: nowrap;
        }
        .small-font {
            font-size: 10px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Laporan Penerima KMS</h1>
    <table>
        <thead>
            <tr>
                <th>Nomor Kartu Keluarga</th>
                <th>Nama Kepala Keluarga</th>
                <th>Jumlah Saudara</th>
                <th>Jumlah Anak</th>
                <th>Biaya Kebutuhan Tiap Bulan</th>
                <th>Biaya Sekolah Anak</th>
                <th>Pendapatan Keluarga</th>
                <th class="nowrap small-font">Status Tempat Tinggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penerimaKms as $penerima)
            <tr>
                <td>{{ $penerima->masyarakat->nomor_kartu_keluarga }}</td>
                <td>{{ $penerima->masyarakat->nama_kepala_keluarga }}</td>
                <td>{{ $penerima->masyarakat->saudara }}</td>
                <td>{{ $penerima->masyarakat->jumlah_anak }}</td>
                <td>{{ $penerima->masyarakat->biaya_kebutuhan_tiap_bulan }}</td>
                <td>{{ $penerima->masyarakat->biaya_sekolah_anak }}</td>
                <td>{{ $penerima->masyarakat->pendapatan_keluarga }}</td>
                <td class="nowrap small-font">{{ $penerima->masyarakat->status_tempat_tinggal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
