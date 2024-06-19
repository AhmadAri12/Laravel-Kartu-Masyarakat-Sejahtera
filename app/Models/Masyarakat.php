<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    use HasFactory;

    // Menentukan field yang boleh diisi secara massal
    protected $fillable = [
        'nomor_kartu_keluarga',
        'nama_kepala_keluarga',
        'nama_istri',
        'saudara',
        'jumlah_anak',
        'biaya_kebutuhan_tiap_bulan',
        'biaya_sekolah_anak',
        'pendapatan_keluarga',
        'status_tempat_tinggal'
    ];

    // Mendefinisikan relasi hasMany dengan model PenerimaKms
    public function penerimaKms()
    {
        // Masyarakat memiliki banyak entitas PenerimaKms
        return $this->hasMany(PenerimaKms::class);
    }
}
