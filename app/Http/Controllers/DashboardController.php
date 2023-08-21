<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function versionone()
    {

       
      
       return view('dashboard.v1');
  
  
    }
    public function versiontwo()
    {
        return view('dashboard.v2');
    }
    public function versionthree()
    {
        return view('dashboard.v3');
    }
}
