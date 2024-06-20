<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaKms extends Model
{
    use HasFactory;

    protected $fillable = ['masyarakat_id'];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class);
    }
}


