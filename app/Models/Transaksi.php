<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];

    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function area()
    {
        return $this->belongsTo(AreaParkir::class, 'id_area');
    }
}
