<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{

    protected $guarded = [];

    public function pelanggan()
    {
        return $this->belongsTo('App\Pelanggan');
    }

    public function produk()
    {
        return $this->belongsTo('App\Produk', 'hargas_id');
    }

    protected $table = 'transaksi';

    use HasFactory;
}
