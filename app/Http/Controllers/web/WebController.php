<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebController extends Controller
{
   public function index (){
    return view('pageweb.index');
   }

}
