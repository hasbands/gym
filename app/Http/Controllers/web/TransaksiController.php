<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\MasterPaket;
use App\Models\MasterSuplemen;
use App\Models\User;
use App\Models\Membership;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class TransaksiController extends Controller
{
   public function transaksi($id)
   {
      $paket = MasterPaket::find($id);
      $suplemen = MasterSuplemen::all();
      return view('pageweb.transaksi.transaksi', compact('paket', 'suplemen'));
   }
   public function addMembership(Request $request)
   {
      $request->validate([
         'master_paket_id' => 'required|exists:master_pakets,id',
         'master_suplemen_id' => 'nullable|exists:master_suplemens,id',
         'jumlah_suplemen' => 'nullable|integer|min:0',
         'user_id' => 'required|exists:users,id',
         'total_bayar' => 'required|numeric'
      ]);

      // // Cek membership yang expired dan hapus
      // $existingPendingMembership = Membership::where('user_id', $request->user_id)
      //    ->where('member_status', 'expired')
      //    ->first();

      // if ($existingPendingMembership) {
      //    $existingPendingMembership->delete();
      // }

      // Cek membership yang aktif
      $existingSuccessMembership = Membership::where('user_id', $request->user_id)
         ->where('member_status', 'aktif')
         ->first();

      if ($existingSuccessMembership) {
         Alert::error('Error', 'Pengguna sudah memiliki membership aktif!');
         return redirect()->back();
      }

      // Kurangi stok suplemen jika ada
      if ($request->jumlah_suplemen && $request->master_suplemen_id) {
         $suplemen = MasterSuplemen::findOrFail($request->master_suplemen_id);
         $suplemen->stok -= $request->jumlah_suplemen;
         $suplemen->save();
      }

      // Set tanggal mulai dan selesai
      $mulai = Carbon::now();
      $selesai = $mulai->copy();

      if ($request->master_paket_id) {
         $paket = MasterPaket::findOrFail($request->master_paket_id);
         $selesai->addDays($paket->durasi);
      }

      // Setup Midtrans
      $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';
      $serverKey = env('MIDTRANS_SERVER_KEY');
      $authString = base64_encode($serverKey . ':');
      $headers = [
         'Accept: application/json',
         'Content-Type: application/json',
         'Authorization: Basic ' . $authString,
      ];

      $orderId = 'MEM-' . rand(1000, 9999) . '-' . time();

      $payload = [
         'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => $request->total_bayar,
         ],
         'customer_details' => [
            'first_name' => auth()->user()->nama,
            'email' => auth()->user()->email,
         ],
      ];

      try {
         $ch = curl_init($url);
         curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
         ]);

         $response = curl_exec($ch);

         if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch));
         }

         curl_close($ch);

         $midtransResponse = json_decode($response, true);

         if (isset($midtransResponse['token'])) {
            Membership::create([
               'order_id' => $orderId,
               'user_id' => $request->user_id,
               'master_paket_id' => $request->master_paket_id,
               'master_suplemen_id' => $request->master_suplemen_id,
               'jumlah_suplemen' => $request->jumlah_suplemen,
               'mulai' => $mulai,
               'selesai' => $selesai,
               'metode_pembayaran' => 'midtrans',
               'snap_token' => $midtransResponse['token'],
               'total_bayar' => $request->total_bayar,
               'member_status' => 'pending',
               'status_pembayaran' => 'pending'
            ]);

            Alert::success('Berhasil', 'Membership berhasil dibuat! Link pembayaran telah dibuat.');
            return redirect()->route('web.transaksi_detail', $orderId);
         } else {
            throw new \Exception('Gagal membuat link pembayaran!');
         }
      } catch (\Exception $e) {
         Alert::error('Error', $e->getMessage());
         return redirect()->back();
      }
   }

   public function transaksi_detail($id)
   {
      $transaksi = Membership::with('masterPaket', 'masterSuplemen')->where('user_id', auth()->id())->where('order_id', $id)->latest()->firstOrFail();
      return view('pageweb.transaksi.pay_membership', compact('transaksi'));
   }

   public function success($order_id)
   {
      $transaksi = Membership::where('user_id', auth()->id())
         ->where('order_id', $order_id)
         ->latest()
         ->firstOrFail();

      $transaksi->update([
         'status_pembayaran' => 'success',
         'member_status' => 'aktif'
      ]);

      return view('pageweb.transaksi.success', [
         'transaksi' => $transaksi,
         'order_id' => $order_id
      ]);
   }
}
