<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MasterSuplemen;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class MasterSuplemenController extends Controller
{
    public function index()
    {
        $masterSuplemen = MasterSuplemen::all();
        return view('pageadmin.masterSuplemen.index', compact('masterSuplemen'));
    }

    public function create()
    {
        return view('pageadmin.masterSuplemen.create');
    }

    public function store(Request $request)
    {
        $masterSuplemen = MasterSuplemen::create($request->all());
        Alert::success('Success', 'Master Suplemen berhasil ditambahkan');
        return redirect()->route('masterSuplemen.index');
    }

    public function edit($id)
    {
        $masterSuplemen = MasterSuplemen::find($id);
        return view('pageadmin.masterSuplemen.edit', compact('masterSuplemen'));
    }

    public function update(Request $request, $id)
    {
        $masterSuplemen = MasterSuplemen::find($id);
        $masterSuplemen->update($request->all());
        Alert::success('Success', 'Master Suplemen berhasil diubah');
        return redirect()->route('masterSuplemen.index');
    }

    public function destroy($id)
    {
        $masterSuplemen = MasterSuplemen::find($id);
        $masterSuplemen->delete();
        Alert::success('Success', 'Master Suplemen berhasil dihapus');
        return redirect()->route('masterSuplemen.index');
    }
}
