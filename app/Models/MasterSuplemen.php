<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSuplemen extends Model
{
    use HasFactory;
    protected $table = 'master_suplemens';
    protected $fillable = ['nama_suplemen', 'harga', 'stok'];

    public function membership()
    {
        return $this->hasMany(Membership::class, 'master_suplemen_id');
    }
}
