<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Membership;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ProfilUserController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->id());
        $membership = Membership::with(['masterPaket', 'masterSuplemen', 'user'])
            ->where('user_id', auth()->id())
            ->where('member_status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->first();
        return view('pageweb.profil.profil', compact('user', 'membership'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('images/profil'), $filename);
            $data['foto'] = $filename;
        }

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        Alert::success('Berhasil', 'Profil berhasil diperbarui');
        return redirect()->back();
    }

    public function cetakkartu()
    {
        $user = User::find(auth()->id());
        $member = Membership::with(['masterPaket', 'masterSuplemen', 'user'])
            ->where('user_id', auth()->id())
            ->where('member_status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->first();
        return view('pageweb.profil.cetakkartu', compact('user', 'member'));
    }


    public function generateqr()
    {
        $user = User::find(auth()->id());
        $member = Membership::with(['masterPaket', 'masterSuplemen', 'user'])
            ->where('user_id', auth()->id())
            ->where('member_status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->first();
            $order_id = $member->order_id; // Ganti d engan order_id sebenarnya
            $url = route('outputqr', ['order_id' => $order_id]); // Menghasilkan URL ke outputqr
        
            $qrCode = QrCode::size(300)->generate($url);
        
            return view('pageweb.profil.generateqr', compact('qrCode', 'url'));;
    }

    public function outputqr($order_id)
    {
        $user = User::find(auth()->id());
        $member = Membership::with(['masterPaket', 'masterSuplemen', 'user'])
            ->where('user_id', auth()->id())
            ->where('member_status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->first();
        return view('pageweb.profil.outputqr', compact('user', 'member'));
    }
}
