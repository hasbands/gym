<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Membership;
use App\Models\User;
use App\Models\MasterPaket;
use App\Models\MasterSuplemen;
use App\Models\WhatsappApi;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class AddMembershipController extends Controller
{
    public function index()
    {
        $membership = Membership::with('user', 'masterPaket', 'masterSuplemen')
            ->orderBy('member_status', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pageadmin.add-membership.index', compact('membership'));
    }

    public function create()
    {
        // Dapatkan user yang memiliki role user saja
        $user = User::where('role', 'user')
            ->whereNotExists(function($query) {
                $query->select('user_id')
                    ->from('memberships')
                    ->whereColumn('user_id', 'users.id')
                    ->where('member_status', 'aktif');
            })
            ->whereExists(function($query) {
                $query->select('user_id')
                    ->from('memberships')
                    ->whereColumn('user_id', 'users.id')
                    ->where('member_status', 'expired')
                    ->orWhereNull('member_status');
            })
            ->orWhere(function($query) {
                $query->where('role', 'user')
                    ->doesntHave('membership');
            })
            ->get();

        $masterPaket = MasterPaket::all();
        $masterSuplemen = MasterSuplemen::all();
        return view('pageadmin.add-membership.create', compact('user', 'masterPaket', 'masterSuplemen')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'master_paket_id' => 'nullable|exists:master_pakets,id',
            'master_suplemen_id' => 'nullable|exists:master_suplemens,id', 
            'jumlah_suplemen' => 'nullable|integer|min:0',
            'metode_pembayaran' => 'required',
            'total_bayar' => 'required|numeric',
            'member_status' => 'required',
            'status_pembayaran' => 'required',
        ]);

        $user = User::find($request->user_id);
        if (!$user) {
            Alert::error('Error', 'Member tidak ditemukan');
            return redirect()->back();
        }

        // Cek apakah user sudah memiliki membership aktif
        $existingMembership = Membership::where('user_id', $request->user_id)
            ->where('member_status', 'aktif')
            ->first();

        if ($existingMembership) {
            Alert::error('Error', 'Member sudah memiliki membership aktif');
            return redirect()->back();
        }

        if ($request->jumlah_suplemen && $request->master_suplemen_id) {
            $suplemen = MasterSuplemen::findOrFail($request->master_suplemen_id);
            $suplemen->stok -= $request->jumlah_suplemen;
            $suplemen->save();
        }

        $mulai = now();
        $selesai = $mulai;

        if ($request->master_paket_id == null) {
            // Jika tidak memilih paket
            $selesai = (clone $mulai)->addDay();
            
        } elseif ($request->master_paket_id) {
            // Jika memilih paket lainnya
            $paket = MasterPaket::findOrFail($request->master_paket_id);
            $selesai = (clone $mulai)->addDays($paket->durasi);
        }

        Membership::create([
            'order_id' => 'MEM-' . rand(1000, 9999) . '-' . time(),
            'user_id' => $request->user_id,
            'master_paket_id' => $request->master_paket_id,
            'master_suplemen_id' => $request->master_suplemen_id,
            'jumlah_suplemen' => $request->jumlah_suplemen,
            'mulai' => $mulai,
            'selesai' => $selesai,
            'metode_pembayaran' => $request->metode_pembayaran,
            'snap_token' => $request->snap_token,
            'total_bayar' => $request->total_bayar,
            'member_status' => $request->member_status,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        Alert::success('Success', 'Membership berhasil dibuat');
        return redirect()->route('adminMembership.index');
    }

    public function edit($id)
    {
        $membership = Membership::findOrFail($id);
        $user = User::where('role', 'user')->get();
        $masterPaket = MasterPaket::all();
        $masterSuplemen = MasterSuplemen::all();
        return view('pageadmin.add-membership.edit', compact('membership', 'user', 'masterPaket', 'masterSuplemen'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'master_paket_id' => 'nullable|exists:master_pakets,id',
            'master_suplemen_id' => 'nullable|exists:master_suplemens,id',
            'jumlah_suplemen' => 'nullable|integer|min:0', 
            'metode_pembayaran' => 'required',
            'total_bayar' => 'required|numeric',
            'member_status' => 'required',
            'status_pembayaran' => 'required',
        ]);

        $membership = Membership::findOrFail($id);

        $mulai = now();
        $selesai = $mulai;

        if ($request->master_paket_id == null) {
            // Jika tidak memilih paket
            $selesai = (clone $mulai)->addDay();
        } elseif ($request->master_paket_id) {
            // Jika memilih paket lainnya
            $paket = MasterPaket::findOrFail($request->master_paket_id);
            $selesai = (clone $mulai)->addDays($paket->durasi);
        }

        $membership->update([
            'user_id' => $request->user_id,
            'master_paket_id' => $request->master_paket_id,
            'master_suplemen_id' => $request->master_suplemen_id,
            'jumlah_suplemen' => $request->jumlah_suplemen,
            'mulai' => $mulai,
            'selesai' => $selesai,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_bayar' => $request->total_bayar,
            'member_status' => $request->member_status,
            'status_pembayaran' => $request->status_pembayaran
        ]);

        Alert::success('Sukses', 'Data membership berhasil diperbarui');
        return redirect()->route('adminMembership.index');
    }

    public function destroy($id)
    {
        $membership = Membership::findOrFail($id);
        $membership->delete();

        Alert::success('Sukses', 'Data membership berhasil dihapus');
        return redirect()->route('adminMembership.index');
    }

    public function cekstatus(Request $request)
    {
        // Ambil semua membership
        $memberships = Membership::all();

        // Cek setiap membership
        foreach($memberships as $membership) {
            // Jika tanggal selesai sudah lewat dari hari ini
            if($membership->selesai < now()) {
                // Update status menjadi expired
                $membership->member_status = 'expired';
                $membership->save();
            }
        }

        Alert::success('Success', 'Status membership berhasil diperbarui');
        return redirect()->route('adminMembership.index');
    }

    public function sendmessage()
    {
        $token = WhatsappApi::first()->account_token;
        // Ambil membership yang akan habis besok
        $memberships = Membership::whereDate('selesai', now()->addDay())->get();
        
        if($memberships->isEmpty()) {
            Alert::warning('Peringatan', 'Tidak ada membership yang akan berakhir besok');
            return redirect()->route('adminMembership.index');
        }

        // Ambil nomor whatsapp dari user
        foreach($memberships as $membership) {
            $target = $membership->user->no_whatsapp;
            $message = 'Membership anda akan segera habis besok, silahkan segera melakukan pembayaran';

            $response = Http::withoutVerifying()->get('https://api.fonnte.com/send', [
                'token' => $token,
                'target' => $target, 
                'message' => $message,
            ]);
        }

        Alert::success('Sukses', 'Pesan berhasil dikirim ke semua member');
        return redirect()->route('adminMembership.index');
    }
}
