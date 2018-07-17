<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Validator;

class PortfolioValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      Validator::extend('get_stock_price',function($attribute,$value,$parameters,$validator){
        function getStockPrice($code){
          $url = "https://www.google.com/finance/getprices?&x=TYO&i=1800&p=2d&f=c&q=$code";
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $html =  curl_exec($ch);
          curl_close($ch);

          $stockPrice = explode("\n", $html);
          return current(array_slice($stockPrice, -2, 1, true));
        }

        if (intval(getStockPrice($value)) == 0) {
          return false;
        }else{
          return true;
        }
      });


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
