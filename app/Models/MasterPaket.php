<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPaket extends Model
{
    use HasFactory;
    protected $table = 'master_pakets';
    protected $fillable = ['nama_paket', 'durasi', 'harga'];

    public function membership()
    {
        return $this->hasMany(Membership::class, 'master_paket_id');
    }
}
