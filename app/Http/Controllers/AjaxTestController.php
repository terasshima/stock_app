<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Stock;
use App\Bill;
use App\Asset;


class AjaxTestController extends Controller
{
    public function index() {
        $this->ajaxTest();
        return view('ajax_test');
    }

    public function ajaxTest() {
        $items = Stock::all();

        return response()->json($items);
    }

    public function printTest() {
        $print = 'AAABBBCCC';
        return view('ajax_test', [
            'print' => $print
        ]);
    }
}
