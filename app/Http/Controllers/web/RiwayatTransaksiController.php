<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Membership;
class RiwayatTransaksiController extends Controller
{
   public function index (){
    $membership = Membership::with(['masterPaket', 'masterSuplemen'])
                          ->where('user_id', auth()->id())
                          ->orderBy('created_at', 'desc')
                          ->get();
    return view('pageweb.transaksi.riwayat', compact('membership'));
   }

}
