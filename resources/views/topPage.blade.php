<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Portfolio Viewer</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.0.2/Chart.min.js"></script>

    <!-- <script src="js/chart.js"></script> !-->


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	<div id="hello">
	    <div class="container">
	    	<div class="row">
	    		<div class="col-lg-8 col-lg-offset-2 centered">
	    			<h1>Portfolio Viewer</h1>
	    			<h2>あなたの株式ポートフォリオを見える化しませんか？</h2>
	    		</div><!-- /col-lg-8 -->

	    	</div><!-- /row -->

	    </div> <!-- /container -->
      @guest

      @else
      <div class="row centered">
        <div class="a-conf">
          <a href="/view" class="btn btn-primary">ポートフォリオ一覧ページ</a>

          <a href="/make" class="btn btn-primary">ポートフォリオ作成ページ</a>
        </div>
          <br>
          <br>

        <form action="/logout" method="post">
          {{ csrf_field() }}
          <input class="btn btn-primary" type="submit" value="ログアウト">
        </form>

      </div>
      @endguest
	</div><!-- /hello -->

@guest
	<div id="green">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 centered">
					<img src="img/computer_pc_PNG17485.png" alt="">
				</div>

				<div class="col-lg-7 centered">
					<h3>ポートフォリオ、管理出来てますか？</h3>
          <p>あなたはポートフォリオをどのように管理しているでしょうか？
          <br>私たちはあなたのポートフォリオを図式化し、一目で保有株式の割合がわかるようなサービスを提供します</p>
				</div>
			</div>
		</div>
	</div>
  @else

@endguest

@guest
  <div id="skills">
		<div class="container">
			<div class="row">
				<div class="col-sm-5 centered col-md-5 centered">
          <h2>例えばこんな風に</h2>
          <br>
          <p>私たちは株価を30分ごとに自動取得し、グラフを作成します。
            また、投資元本も入力いただくことで、どれほど資産が増えたのかも把握することも出来ます。</p>
				</div>

				<div class="col-sm-7 centered col-md-7 centered">
            <canvas id="index" height="65" width="125" margin-right="190px"></canvas>
          <script>

          window.onload = function() {
           var ctx = document.getElementById("index").getContext("2d");
           var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
              labels:["A社", "B社", "C社", "D社", "E社"],
              datasets:[{
                label:"ポートフォリオ",
                backgroundColor: ["green", "yellow", "blue", "red", "gray"],
                borderColor: 'rgb(0, 0, 0)',
                data:[37,25,18,12,8],
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

				</div>
			</div>
		</div>
	</div>
  @else

@endguest



@guest
	<section id="contact"></section>
	<div id="social">
		<div class="container">
			<div class="row centered">

				<h1>さあ、はじめてみましょう！</h1>
        <div class="a-conf">
          <a href="/login" class="btn btn-primary">ログイン<span class="balloon">既に会員登録された方はこちら！</span></a>

          <a href="/register" class="btn btn-primary">会員登録<span class="balloon"><span>まだ会員登録されていない方はこちら！</span></a>
        </div>

      </div>
		</div><!-- /container -->
	</div><!-- /social -->
  @else

@endguest


	<div id="f">
		<div class="container">
			<div class="row">
        @guest
        <p>Let's have a wonderful investor life!</p>
        @else
        <p>See you again!</p>
        @endguest
        <p>Producer.hiroaki</p>
        <p>Contact: <a href="https://twitter.com/wakiositatuyosi">twitter@wakiositatuyosi</a></p>
			</div>
		</div>
	</div>

  <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="assets/js/bootstrap.js"></script>
    </body>
  </html>
