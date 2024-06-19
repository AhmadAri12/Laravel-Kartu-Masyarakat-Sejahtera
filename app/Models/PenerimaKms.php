<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaKms extends Model
{
    use HasFactory;

    // Menentukan field yang boleh diisi secara massal
    protected $fillable = ['masyarakat_id'];

    // Mendefinisikan relasi belongsTo dengan model Masyarakat
    public function masyarakat()
    {
        // PenerimaKms berhubungan dengan satu entitas Masyarakat
        return $this->belongsTo(Masyarakat::class);
    }
}
