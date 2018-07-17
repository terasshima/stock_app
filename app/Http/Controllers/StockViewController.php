<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Stock;
use App\Bill;
use App\Asset;
use App\Http\Controllers\Controller;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use ConsoleTVs\Charts\Classes\Highcharts\Dataset;



class StockViewController extends Controller
{
  public function show(Request $request){
      $items = Stock::where('user_id',$request->user()->id)->get();
      $cashPosition = Bill::where('user_id',$request->user()->id)->value('cash');
      $investmentPrincipal = Asset::where('user_id',$request->user()->id)->value('principal');
      $user = Auth::user();

      if (isset($items[0]) == false) {
        return redirect('/make');
      }elseif (isset($cashPosition) == false) {
        return redirect('/make');
      }elseif (isset($investmentPrincipal) == false) {
        return redirect('/make');
      }else{
        return view('portfolio_view', [
          'items' => $items,
          'user' => $user,
          'cashPosition' => $cashPosition,
          'investmentPrincipal' => $investmentPrincipal,
        ]);
      }
  }


  public function post(Request $request){
      return redirect('/make');
  }
}
