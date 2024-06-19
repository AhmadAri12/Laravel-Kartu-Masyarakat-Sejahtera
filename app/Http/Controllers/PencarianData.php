<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenerimaKms;

class PencarianData extends Controller
{
    // Fungsi ini digunakan untuk mencari data KMS berdasarkan request yang diberikan
    public function searchKMS(Request $request)
    {
        // Membuat query yang menghubungkan model PenerimaKms dengan relasi 'masyarakat'
        $query = PenerimaKms::with('masyarakat');
        
        // Mengecek apakah request memiliki parameter 'nomor_kartu_keluarga'
        if ($request->filled('nomor_kartu_keluarga')) {
            // Jika ada, tambahkan kondisi ke query untuk mencari data berdasarkan 'nomor_kartu_keluarga'
            $query->whereHas('masyarakat', function ($q) use ($request) {
                // Menambahkan kondisi where pada query relasi 'masyarakat'
                $q->where('nomor_kartu_keluarga', $request->nomor_kartu_keluarga);
            });
        }
        
        // Menjalankan query dan mendapatkan hasilnya
        $results = $query->get();
        
        // Mengembalikan view 'welcome' dengan data hasil pencarian
        return view('welcome', compact('results'));
    }
}
