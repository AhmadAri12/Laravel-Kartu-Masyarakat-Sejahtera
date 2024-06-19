<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenerimaKms;
class PencarianData extends Controller
{
    public function searchKMS(Request $request)
    {
        $query = PenerimaKms::with('masyarakat');

        if ($request->filled('nomor_kartu_keluarga')) {
            $query->whereHas('masyarakat', function ($q) use ($request) {
                $q->where('nomor_kartu_keluarga', $request->nomor_kartu_keluarga);
            });
        }
        
        $results = $query->get();

        return view('welcome', compact('results'));
    }


}
