<?php
// app/Http/Controllers/PenerimaKmsController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use App\Models\PenerimaKms;
use Barryvdh\DomPDF\Facade as PDF;
use App\Services\DecisionTree;

class PenerimaKmsController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil input pencarian
        $search = $request->input('search');

        // Mengambil data masyarakat, menerapkan filter pencarian jika ada
        $masyarakats = Masyarakat::where(function($query) use ($search) {
            if ($search) {
                $query->where('nama_kepala_keluarga', 'LIKE', '%' . $search . '%');
            }
        })->get();

        // Buat dataset untuk pohon keputusan
        $data = [];
        foreach ($masyarakats as $masyarakat) {
            // Hitung rata-rata
            $average = ($masyarakat->biaya_kebutuhan_tiap_bulan + $masyarakat->biaya_sekolah_anak + $masyarakat->pendapatan_keluarga) / 3;

            // Sesuaikan rata-rata berdasarkan status tempat tinggal
            if ($masyarakat->status_tempat_tinggal == 'Ngontrak') {
                $average -= 700000;
            }

            // Tentukan label berdasarkan rata-rata yang sudah disesuaikan
            $label = $average < 300000 ? 'Penerima KMS' : 'Bukan Penerima KMS';

            $data[] = [
                'biaya_kebutuhan_tiap_bulan' => $masyarakat->biaya_kebutuhan_tiap_bulan,
                'biaya_sekolah_anak' => $masyarakat->biaya_sekolah_anak,
                'pendapatan_keluarga' => $masyarakat->pendapatan_keluarga,
                'status_tempat_tinggal' => $masyarakat->status_tempat_tinggal,
                'label' => $label
            ];
        }

        // Buat pohon keputusan
        $tree = new DecisionTree($data);

        // Hapus data penerima KMS yang ada dan masukkan data baru
        PenerimaKms::truncate();
        foreach ($masyarakats as $masyarakat) {
            $row = [
                'biaya_kebutuhan_tiap_bulan' => $masyarakat->biaya_kebutuhan_tiap_bulan,
                'biaya_sekolah_anak' => $masyarakat->biaya_sekolah_anak,
                'pendapatan_keluarga' => $masyarakat->pendapatan_keluarga,
                'status_tempat_tinggal' => $masyarakat->status_tempat_tinggal
            ];

            $label = $tree->classify($row);
            if ($label === 'Penerima KMS') {
                PenerimaKms::create(['masyarakat_id' => $masyarakat->id]);
            }
        }

        // Mengambil semua data PenerimaKms dengan data masyarakat yang terkait
        $penerimaKms = PenerimaKms::with('masyarakat')->get();

        // Mengembalikan view dengan data penerima KMS
        return view('penerima_kms.index', compact('penerimaKms'));
    }

    public function cetak()
    {
        // Mengambil semua data masyarakat untuk laporan
        $penerimaKms = PenerimaKms::all();

        // Load view 'masyarakat.report' dan generate PDF
        $pdf = PDF::loadView('penerima_kms.report', compact('penerimaKms'));

        // Download file PDF dengan nama 'masyarakat_report.pdf'
        return $pdf->download('penerima_kms.pdf');
    }
}



