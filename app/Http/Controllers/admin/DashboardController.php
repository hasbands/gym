<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class DashboardController extends Controller
{
 public function index(){
    return view('pageadmin.dashboard.index');
 }
}
