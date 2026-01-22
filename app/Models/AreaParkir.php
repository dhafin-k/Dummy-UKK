<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    protected $guarded = [];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_area');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_area');
    }
}
