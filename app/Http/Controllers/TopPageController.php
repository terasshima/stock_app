<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;



class TopPageController extends Controller
{
  public function top(){
    return view('topPage');
  }


}
