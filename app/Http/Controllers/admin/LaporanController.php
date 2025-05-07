<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Membership;
use App\Models\MasterSuplemen;
use App\Models\User;
use App\Models\PaketHarian;
use App\Models\Transaksi;

class LaporanController extends Controller
{
   public function index()
   {

      return view('pageadmin.laporan.index');
   }

   public function laporanbulanan()
   {
      $laporan = Membership::where('created_at', '>=', now()->startOfMonth())->where('created_at', '<=', now()->endOfMonth())->with('masterPaket', 'user', 'masterSuplemen')->get();
      return view('pageadmin.laporan.laporanbulanan', compact('laporan'));
   }

   public function laporanharian()
   {
      $laporan = PaketHarian::where('created_at', '>=', now()->startOfDay())->where('created_at', '<=', now()->endOfDay())->get();
      return view('pageadmin.laporan.laporanharian', compact('laporan'));
   }
}
