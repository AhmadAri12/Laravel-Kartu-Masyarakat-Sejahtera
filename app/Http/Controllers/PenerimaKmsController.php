<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\PenerimaKms;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\DecisionTreeService;
use Illuminate\Support\Facades\Log;

class PenerimaKmsController extends Controller
{
    // Properti untuk menyimpan instance dari DecisionTreeService
    protected $decisionTreeService;

    // Konstruktor untuk menginisialisasi DecisionTreeService
    public function __construct(DecisionTreeService $decisionTreeService)
    {
        $this->decisionTreeService = $decisionTreeService;
    }

    // Metode untuk menampilkan daftar penerima KMS
    public function index()
    {
        // Mengambil semua data masyarakat
        $masyarakatList = Masyarakat::all();

        // Mengevaluasi setiap masyarakat apakah memenuhi syarat sebagai penerima KMS
        foreach ($masyarakatList as $masyarakat) {
            $isPenerima = $this->decisionTreeService->evaluateCriteria($masyarakat);
            if ($isPenerima === 1) {
                // Jika memenuhi syarat, tambahkan atau perbarui data penerima KMS
                PenerimaKms::updateOrCreate(
                    ['masyarakat_id' => $masyarakat->id]
                );
            } elseif ($isPenerima === null) {
                // Jika ada kesalahan saat evaluasi, catat peringatan ke log
                Log::warning('Failed to evaluate criteria for masyarakat ID: ' . $masyarakat->id);
            }
        }

        // Mengambil semua data penerima KMS beserta data masyarakat terkait
        $penerimaKms = PenerimaKms::with('masyarakat')->get();

        // Menampilkan data penerima KMS di view
        return view('penerima_kms.index', compact('penerimaKms'));
    }

    // Metode untuk mencetak laporan penerima KMS dalam format PDF
    public function cetak()
    {
        // Mengambil semua data penerima KMS
        $penerimaKms = PenerimaKms::all();

        // Membuat PDF dari view 'penerima_kms.report' dengan data penerima KMS
        $pdf = Pdf::loadview('penerima_kms.report', compact('penerimaKms'));

        // Mengunduh PDF dengan nama 'penerima_kms_report.pdf'
        return $pdf->download('penerima_kms_report.pdf');
    }

    // Metode untuk melatih decision tree dengan data masyarakat
    public function trainDecisionTree()
    {
        // Mengambil semua data masyarakat
        $masyarakatList = Masyarakat::all();

        $samples = [];
        $labels = [];

        // Membuat sampel dan label dari data masyarakat
        foreach ($masyarakatList as $masyarakat) {
            $samples[] = [
                $masyarakat->saudara,
                $masyarakat->jumlah_anak,
                $masyarakat->biaya_kebutuhan_tiap_bulan + ($masyarakat->biaya_sekolah_anak ?? 0),
                $masyarakat->pendapatan_keluarga,
                $masyarakat->status_tempat_tinggal === 'ngontrak' ? 1 : 0
            ];

            // Label: 1 untuk penerima KMS, 0 untuk bukan penerima KMS
            $labels[] = ($masyarakat->saudara > 4 && $masyarakat->jumlah_anak > 3 && ($masyarakat->biaya_kebutuhan_tiap_bulan + ($masyarakat->biaya_sekolah_anak ?? 0)) > $masyarakat->pendapatan_keluarga && $masyarakat->status_tempat_tinggal === 'ngontrak') ? 1 : 0;
        }

        // Melatih decision tree dengan sampel dan label
        $this->decisionTreeService->train($samples, $labels);

        // Mengembalikan respons JSON bahwa pelatihan berhasil
        return response()->json(['message' => 'Decision tree trained successfully']);
    }
}
