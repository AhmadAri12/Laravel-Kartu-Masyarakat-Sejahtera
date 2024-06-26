<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class MasyarakatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $masyarakats = Masyarakat::where('nama_kepala_keluarga', 'like', "%{$search}%")->paginate(10);
        return view('masyarakat.index', compact('masyarakats'));
    }

    public function create()
    {
        return view('masyarakat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kartu_keluarga' => 'required|numeric|unique:masyarakats',
            'nama_kepala_keluarga' => 'required|string|max:255',
            'nama_istri' => 'nullable|string|max:255',
            'jumlah_anak' => 'required|integer',
            'biaya_kebutuhan_tiap_bulan' => 'required|numeric',
            'biaya_sekolah_anak' => 'nullable|numeric',
            'pendapatan_keluarga' => 'required|numeric',
            'status_tempat_tinggal' => 'required|string|max:255',
        ]);

        Masyarakat::create($validated);
        return redirect()->route('masyarakat.index')->with('success', 'Data masyarakat berhasil disimpan.');
    }

    public function show($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        return view('masyarakat.show', compact('masyarakat'));
    }

    public function edit($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        return view('masyarakat.edit', compact('masyarakat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kartu_keluarga' => 'required|numeric|unique:masyarakats,nomor_kartu_keluarga,'.$id,
            'nama_kepala_keluarga' => 'required|string|max:255',
            'nama_istri' => 'nullable|string|max:255',
            'jumlah_anak' => 'required|integer',
            'biaya_kebutuhan_tiap_bulan' => 'required|numeric',
            'biaya_sekolah_anak' => 'nullable|numeric',
            'pendapatan_keluarga' => 'required|numeric',
            'status_tempat_tinggal' => 'required|string|max:255',
        ]);

        $masyarakat = Masyarakat::findOrFail($id);
        $masyarakat->update($request->all());
        return redirect()->route('masyarakat.index')->with('success', 'Data masyarakat berhasil diperbarui.');
    }

    public function delete($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        return view('masyarakat.delete', compact('masyarakat'));
    }

    public function destroy($id)
    {
        $masyarakat = Masyarakat::findOrFail($id);
        $masyarakat->delete();
        return redirect()->route('masyarakat.index')->with('success', 'Data masyarakat berhasil dihapus.');
    }

    public function cetak()
    {
        $masyarakats = Masyarakat::all();
        $pdf = PDF::loadView('masyarakat.report', compact('masyarakats'));
        return $pdf->download('masyarakat_report.pdf');
    }
}
