<!-- メインページ。ポートフォリオのグラフ化。 !-->
@extends('layouts.app')



@section('content')
<h3>こんにちは、{{$user->name}}さん！</h3>


<div style="height: 400px; width: 350px;　margin-right:auto; margin-left:auto;">
   <canvas id="mychart" height="130" width="120"></canvas>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.0.2/Chart.min.js"></script>

<script>
var portfolio = <?php
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

  $items_decode = json_decode($items, true);

  for ($i=0; $i < count($items_decode); $i++) {
    $items_decode[$i] = array_merge($items_decode[$i], array('price' => getStockPrice($items_decode[$i]['stock_code'])));
  }
  //株価などのDBをJSON形式に整形
  $portfolio = json_encode($items_decode,JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
  echo $portfolio;
  ?>;

  //グラフを評価額順に時計回りに配置したいので、降順でソート
     function compare( a, b ){
      var r = 0;
      if( a.price * a.holding_number < b.price * b.holding_number ){
         r = -1;
       }
      else if( a.price * a.holding_number > b.price * b.holding_number ){
         r = 1;
       }
      return ( -1 * r );
    }
  　portfolio.sort(compare);

  //Chart.jsのdataにセットするため、企業名と評価額を配列に入れ込む
  var portfolioName = [];
  for (var i = 0; i < portfolio.length; i++) {
    portfolioName.push(portfolio[i].company_name);
  }

  var portfolioPrice = [];
  for (var i = 0; i < portfolio.length; i++) {
    portfolioPrice.push(portfolio[i].price * portfolio[i].holding_number);
  }

  //現金CPをlabelsの最後尾に追加
    portfolioName.push('現金(CP)');
  //現金CPをdataの最後尾に追加
    var cashPosition = <?php echo $cashPosition; ?>;
    portfolioPrice.push(cashPosition);

  //％でグラフ表記をしたいので、データの整形
  var totalPortfolioPrice = 0;
  for (var i = 0; i < portfolioPrice.length; i++) {
    totalPortfolioPrice += portfolioPrice[i];
  }
  var portfolioPricePercent = [];
  for (var i = 0; i < portfolioPrice.length; i++) {
    portfolioPricePercent.push(Math.round(portfolioPrice[i] / totalPortfolioPrice * 100));
  }


  //グラフの色を自動で振り分けたいので、関数を作成。配列を作り、そこにランダムに'rgb()'方式で色を格納していく。
  function addRandomColor(a) {   //aは色の生成回数
    var colorArray = [];
    for (var i = 0; i < a; i++) {
      colorArray.push("rgb(" + (~~(256 * Math.random())) + ", " + (~~(256 * Math.random())) + ", " + (~~(256 * Math.random())) + ")" );
    }
    //現金のグラフの色は黄色にしたいため、for文の後に個別追加
    colorArray.push('yellow');
    return colorArray;
  }


  //data{}に上で定義したportfolioNameとaddRandomColorとportfolioPriceをセット
  window.onload = function() {
     var ctx = document.getElementById("mychart").getContext("2d");
     var chart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels:portfolioName,
        datasets:[{
          label:"ポートフォリオ",
          backgroundColor: addRandomColor(portfolio.length),
          borderColor: 'rgb(0, 0, 0)',
          data:portfolioPricePercent,
        }]
      },
      options: {
        tooltips:{
          callbacks:{
            label: function(tooltipItem, data){
              return data.labels[tooltipItem.index]
              + ':'
              + data.datasets[0].data[tooltipItem.index]
              + '%'
            }
          }
        }
      }
    });
  }

</script>


    @php
    $portfolio_dec = json_decode($portfolio, true);
    foreach ($portfolio_dec as $key => $value) {
      $sort[$key] = $value['holding_number'] * $value['price'];
    }
    array_multisort($sort, SORT_DESC, $portfolio_dec);

    @endphp
    <div class="container-fluid">
      <div class="table-responsive" style="padding:20px;">
        <table class="table text-nowrap" align="center">
          <tr>
            <th>証券コード</th>
            <th>銘柄名</th>
            <th>株価</th>
            <th>保有数</th>
            <th>平均取得単価</th>
            <th>評価額</th>
            <th>含み損益</th>
          </tr>

          @foreach ($portfolio_dec as $item)
          <tr>
            <td>{{$item['stock_code']}}</td>
            <td>{{$item['company_name']}}</td>
            <td>{{number_format($item['price'])}}</td>
            <td>{{number_format($item['holding_number'])}}</td>
            <td>{{number_format($item['average_price'])}}</td>
            <td>{{number_format($item['price'] * $item['holding_number'])}}</td>
            @if(floor($item['price'] / $item['average_price'] * 100) - 100 < 0)
              <td class="deficit">{{number_format(floor($item['price'] / $item['average_price'] * 100) - 100)}}%</td>
            @else
              <td class="the-black">{{number_format(floor($item['price'] / $item['average_price'] * 100) - 100)}}%</td>
            @endif
          </tr>
          @endforeach
          </table>
        </div>
      </div>

          <table align="center">
            <tr>
              <th>現金(CP)</th>
            </tr>
            <tr>
              <td>{{number_format($cashPosition)}}</td>
            </tr>
          </table>

          <br>
      <div class="container-fluid">
        <div class="table-responsive" style="padding:20px;">
          <table class="table text-nowrap" align="center">
          <tr>
            <th>投資元本</th>
            <th>総資産</th>
            <th>総利益</th>
            <th>資産増加率</th>
          </tr>

          <tr>
            <td>{{number_format($investmentPrincipal)}}</td>
            @php
              $totalValuation = 0;
              for($i=0; $i < count($portfolio_dec); $i++){
                $totalValuation += $portfolio_dec[$i]['price'] * $portfolio_dec[$i]['holding_number'];
              }
            @endphp
            <td>{{number_format($totalValuation + $cashPosition)}}</td>

            @if($totalValuation + $cashPosition - $investmentPrincipal < 0)
              <td class="deficit">{{number_format($totalValuation + $cashPosition - $investmentPrincipal)}}</td>
            @else
              <td class="the-black">{{number_format($totalValuation + $cashPosition - $investmentPrincipal)}}</td>
            @endif

            @if(($totalValuation + $cashPosition - $investmentPrincipal) / $investmentPrincipal * 100 < 0)
              <td class="deficit">{{number_format(round(($totalValuation + $cashPosition - $investmentPrincipal) / $investmentPrincipal * 100, 1))}}%</td>
            @else
              <td class="the-black">{{number_format(round(($totalValuation + $cashPosition - $investmentPrincipal) / $investmentPrincipal * 100, 1))}}%</td>
            @endif
          </tr>

          </table>
        </div>
      </div>

          <br>


          <form method="POST" action="/make">
            {{ csrf_field() }}
            <input class="btn-custom" type="submit" value="ポートフォリオ変更">
          </form>

@endsection
