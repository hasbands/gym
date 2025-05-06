<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Membership;
use RealRashid\SweetAlert\Facades\Alert;


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
}
