<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Stock;
use App\Bill;
use App\Asset;
use App\Http\Requests\addStockRequest;
use App\Http\Requests\addPrincipalRequest;
use App\Http\Requests\addCashRequest;
use App\Http\Requests\ToViewRequest;

class MakeController extends Controller
{
  public function show(Request $request){
      $items = Stock::where('user_id',$request->user()->id)->get();

      $cashPosition = Bill::where('user_id',$request->user()->id)->get();
      $investmentPrincipal = Asset::where('user_id',$request->user()->id)->get();

      $user = Auth::user();

      return view('portfolio_make', [
          'items' => $items,
          'user' => $user,
          'cashPosition' => $cashPosition,
          'investmentPrincipal' => $investmentPrincipal,
      ]);
  }

  public function addStock(addStockRequest $request){
      $stock = new Stock;
      $stock->user_id = $request->user()->id;
      $stock->stock_code = $request->stock_code;
      $stock->company_name = $request->company_name;
      $stock->holding_number = $request->holding_number;
      $stock->average_price = $request->average_price;
      $stock->save();

      return redirect('/make');
  }

  public function addPrincipal(addPrincipalRequest $request){
      $asset = new Asset;
      $asset->user_id = $request->user()->id;
      $asset->principal = $request->principal;
      $asset->save();
      return redirect('/make');
  }


  public function addCash(addCashRequest $request){
      $bill = new Bill;
      $bill->user_id = $request->user()->id;
      $bill->cash = $request->cash;
      $bill->save();
      return redirect('/make');
  }

  public function deleteStock($id){
      $stock = Stock::find($id);
      $stock->delete();
      return redirect('/make');
  }

  public function deletePrincipal($id){
      $asset = Asset::find($id);
      $asset->delete();
      return redirect('/make');
  }

  public function deleteCash($id){
      $bill = Bill::find($id);
      $bill->delete();
      return redirect('/make');
  }

  public function post(ToViewRequest $request){
      return redirect('/view');
  }
}
