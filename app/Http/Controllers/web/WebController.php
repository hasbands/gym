<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\MasterPaket;
class WebController extends Controller
{
   public function index (){
    $paket = MasterPaket::take(3)->get();
    return view('pageweb.index', compact('paket'));
   }

   public function about (){
    return view('pageweb.about');
   }

}
