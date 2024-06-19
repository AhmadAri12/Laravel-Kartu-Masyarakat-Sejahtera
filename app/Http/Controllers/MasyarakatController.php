<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MasyarakatController extends Controller
{
    // Fungsi untuk menampilkan daftar masyarakat dengan fitur pencarian
    public function index(Request $request)
    {
        // Mendapatkan input pencarian dari request
        $search = $request->get('search');
        
        // Mencari masyarakat berdasarkan nama kepala keluarga yang sesuai dengan pencarian
        $masyarakats = Masyarakat::where('nama_kepala_keluarga', 'like', "%{$search}%")->paginate(10);
        
        // Menampilkan view 'masyarakat.index' dengan data hasil pencarian
        return view('masyarakat.index', compact('masyarakats'));
    }

    // Fungsi untuk menampilkan form pembuatan masyarakat baru
    public function create()
    {
        return view('masyarakat.create');
    }

    // Fungsi untuk menyimpan data masyarakat baru ke database
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nomor_kartu_keluarga' => 'required|numeric|unique:masyarakats',
            'nama_kepala_keluarga' => 'required|string|max:255',
            'nama_istri' => 'nullable|string|max:255',
            'saudara' => 'required|integer',
            'jumlah_anak' => 'required|integer',
            'biaya_kebutuhan_tiap_bulan' => 'required|numeric',
            'biaya_sekolah_anak' => 'nullable|numeric',
            'pendapatan_keluarga' => 'required|numeric',
            'status_tempat_tinggal' => 'required|string|max:255',
        ]);

        // Menyimpan data yang sudah divalidasi ke database
        Masyarakat::create($validated);

        // Redirect ke halaman daftar masyarakat dengan pesan sukses
        return redirect()->route('masyarakat.index')->with('success', 'Data masyarakat berhasil disimpan.');
    }

    // Fungsi untuk menampilkan detail masyarakat berdasarkan ID
    public function show($id)
    {
        // Mencari data masyarakat berdasarkan ID
        $masyarakat = Masyarakat::findOrFail($id);
        
        // Menampilkan view 'masyarakat.show' dengan data masyarakat yang ditemukan
        return view('masyarakat.show', compact('masyarakat'));
    }

    // Fungsi untuk menampilkan form edit data masyarakat
    public function edit($id)
    {
        // Mencari data masyarakat berdasarkan ID
        $masyarakat = Masyarakat::findOrFail($id);
        
        // Menampilkan view 'masyarakat.edit' dengan data masyarakat yang ditemukan
        return view('masyarakat.edit', compact('masyarakat'));
    }

    // Fungsi untuk mengupdate data masyarakat di database
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nomor_kartu_keluarga' => 'required|numeric|unique:masyarakats,nomor_kartu_keluarga,'.$id,
            'nama_kepala_keluarga' => 'required|string|max:100',
            'nama_istri' => 'nullable|string|max:100',
            'saudara' => 'required|integer',
            'jumlah_anak' => 'required|integer',
            'biaya_kebutuhan_tiap_bulan' => 'required|numeric',
            'biaya_sekolah_anak' => 'nullable|numeric',
            'pendapatan_keluarga' => 'required|numeric',
            'status_tempat_tinggal' => 'required|string|max:100',
        ]);

        // Mencari data masyarakat berdasarkan ID
        $masyarakat = Masyarakat::findOrFail($id);
        
        // Mengupdate data masyarakat dengan data yang baru
        $masyarakat->update($request->all());

        // Redirect ke halaman daftar masyarakat dengan pesan sukses
        return redirect('/masyarakat')->with('success', 'Data masyarakat berhasil diperbarui.');
    }

    // Fungsi untuk menampilkan konfirmasi penghapusan data masyarakat
    public function delete($id)
    {
        // Mencari data masyarakat berdasarkan ID
        $masyarakat = Masyarakat::findOrFail($id);
        
        // Menampilkan view 'masyarakat.delete' dengan data masyarakat yang ditemukan
        return view('masyarakat.delete', compact('masyarakat'));
    }

    // Fungsi untuk menghapus data masyarakat dari database
    public function destroy($id)
    {
        // Mencari data masyarakat berdasarkan ID
        $masyarakat = Masyarakat::findOrFail($id);
        
        // Menghapus data masyarakat
        $masyarakat->delete();

        // Redirect ke halaman daftar masyarakat dengan pesan sukses
        return redirect('/masyarakat')->with('success', 'Data masyarakat berhasil dihapus.');
    }

    // Fungsi untuk mencetak laporan data masyarakat dalam format PDF
    public function cetak()
    {
        // Mengambil semua data masyarakat
        $masyarakats = Masyarakat::all();
        
        // Membuat PDF dari view 'masyarakat.report' dengan data masyarakat
        $pdf = Pdf::loadview('masyarakat.report', compact('masyarakats'));
        
        // Mendownload file PDF dengan nama 'masyarakat_report.pdf'
        return $pdf->download('masyarakat_report.pdf');
    }
}
