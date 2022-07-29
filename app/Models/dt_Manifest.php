<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dt_Manifest extends Model
{
    // use HasFactory;

    protected $table = "dt__manifests";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'manifest_id',
        'inventory_id',
        'nama_inventory',
        'jumlah_inventory'
    ];

    public function manifest()
    {
        return $this->belongsTo(Manifest::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
