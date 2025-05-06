<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Membership;
use App\Models\MasterSuplemen;
use App\Models\User;
use App\Models\PaketHarian;
use App\Models\Transaksi;

class DashboardController extends Controller
{
 public function index(){
    $member_aktif = Membership::where('member_status', 'aktif')->count();
    $keuntungan_mingguan = Membership::where('created_at', '>=', now()->startOfWeek())->where('created_at', '<=', now()->endOfWeek())->sum('total_bayar');
    $jumlah_suplemen = MasterSuplemen::count();
    $keuntungan_bulanan = PaketHarian  ::where('created_at', '>=', now()->startOfMonth())->where('created_at', '<=', now()->endOfMonth())->sum('harga');
    return view('pageadmin.dashboard.index', compact('member_aktif', 'keuntungan_mingguan', 'jumlah_suplemen', 'keuntungan_bulanan'));
 }
}
