<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PaketHarian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaketHarianController extends Controller
{
  public function index()
  {
    $paketHarian = PaketHarian::all();
    return view('pageadmin.paket-harian.index', compact('paketHarian'));
  }

  public function create()
  {
    return view('pageadmin.paket-harian.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'alamat' => 'required', 
      'nomor_wa' => 'required',
    ]);

    $data = $request->all();
    $data['harga'] = 5000;

    PaketHarian::create($data);
    Alert::success('Sukses', 'Paket harian berhasil ditambahkan');
    return redirect()->route('paket-harian.index');
  }

  public function edit($id)
  {
    $paketHarian = PaketHarian::findOrFail($id);
    return view('pageadmin.paket-harian.edit', compact('paketHarian'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required',
      'alamat' => 'required',
      'nomor_wa' => 'required',
    ]);

    $paketHarian = PaketHarian::findOrFail($id);
    $paketHarian->update($request->all());

    Alert::success('Sukses', 'Paket harian berhasil diperbarui');
    return redirect()->route('paket-harian.index');
  }

  public function destroy($id)
  {
    $paketHarian = PaketHarian::findOrFail($id);
    $paketHarian->delete();

    Alert::success('Sukses', 'Paket harian berhasil dihapus');
    return redirect()->route('paket-harian.index');
  }
  
}
