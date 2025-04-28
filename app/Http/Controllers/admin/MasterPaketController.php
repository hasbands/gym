<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MasterPaket;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MasterPaketController extends Controller
{
    public function index()
    {
        $masterPaket = MasterPaket::all();
        return view('pageadmin.masterPaket.index', compact('masterPaket'));
    }

    public function create()
    {
        return view('pageadmin.masterPaket.create');
    }

    public function store(Request $request)
    {
        $masterPaket = MasterPaket::create($request->all());
        Alert::success('Success', 'Master Paket berhasil ditambahkan');
        return redirect()->route('masterPaket.index');
    }

    public function edit($id)
    {
        $masterPaket = MasterPaket::find($id);
        return view('pageadmin.masterPaket.edit', compact('masterPaket'));
    }

    public function update(Request $request, $id)
    {
        $masterPaket = MasterPaket::find($id);
        $masterPaket->update($request->all());
        Alert::success('Success', 'Master Paket berhasil diubah');
        return redirect()->route('masterPaket.index');
    }

    public function destroy($id)
    {
        $masterPaket = MasterPaket::find($id);
        $masterPaket->delete();
        Alert::success('Success', 'Master Paket berhasil dihapus');
        return redirect()->route('masterPaket.index');
    }
}
