<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
    // use HasFactory;

    protected $table = "manifests";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'nama_event',
        'alamat_event',
        'tanggal_event',
        'penanggung_jawab',
        'note',
        'tanggal_kembali',
        'status',
    ];

}
