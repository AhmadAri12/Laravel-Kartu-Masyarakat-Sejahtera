<!-- resources/views/masyarakat/report.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Masyarakat</title>
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
            padding: 6px; /* Perkecil padding */
            text-align: left;
            word-wrap: break-word; /* Tambahkan untuk pemotongan teks */
        }
        th {
            background-color: #f2f2f2;
        }
        .nowrap {
            white-space: nowrap;
        }
        .small-font {
            font-size: 10px; /* Ukuran font lebih kecil untuk kolom sempit */
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Laporan Masyarakat</h1>
    <table>
        <thead>
            <tr>
                <th>Nomor KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Nama Istri</th>
                <th>Jumlah Anak</th>
                <th>Biaya Kebutuhan</th>
                <th>Biaya Sekolah Anak</th>
                <th>Pendapatan Keluarga</th>
                <th class="nowrap small-font">Tempat Tinggal</th>
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
                <td class="nowrap small-font">{{ $masyarakat->status_tempat_tinggal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
