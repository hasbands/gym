<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $table = 'memberships';
    protected $fillable = ['order_id', 'user_id', 'master_paket_id', 'master_suplemen_id', 'mulai', 'selesai', 'metode_pembayaran', 'snap_token', 'total_bayar', 'member_status', 'status_pembayaran'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function masterPaket()
    {
        return $this->belongsTo(MasterPaket::class);
    }
    public function masterSuplemen()
    {
        return $this->belongsTo(MasterSuplemen::class);
    }
}
