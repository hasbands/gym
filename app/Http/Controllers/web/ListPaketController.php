<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\MasterPaket;
use App\Models\MasterSuplemen;

class ListPaketController extends Controller
{
   public function index (){
    $paket = MasterPaket::all();
    return view('pageweb.listpaket', compact('paket'));
   }

}
