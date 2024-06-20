<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masyarakat;
use App\Models\PenerimaKms;

class PencarianKmsController extends Controller
{
    public function index(Request $request)
    {
        $results = collect();

        // Mengambil input pencarian
        $nomor_kartu_keluarga = $request->input('nomor_kartu_keluarga');

        if ($nomor_kartu_keluarga) {
            // Mencari data penerima KMS berdasarkan nomor kartu keluarga
            $results = PenerimaKms::whereHas('masyarakat', function($query) use ($nomor_kartu_keluarga) {
                $query->where('nomor_kartu_keluarga', 'LIKE', '%' . $nomor_kartu_keluarga . '%');
            })->get();
        }

        return view('welcome', compact('results'));
    }
}

