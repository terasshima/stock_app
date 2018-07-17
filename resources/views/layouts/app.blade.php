<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portfolio Viewer</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts-->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style media="screen">
      body{
        font-size: 14px;
      }

      .attention{
        background-color: #ffe8db;
      }

      .error-title{
        color: red;
        font-weight: bold;
      }

      .error-msg{
        color: red;
      }

      .item{
        font-size: 15px;
        margin: 2px;
        padding: 2px;
      }

      tr{
        border:solid 2px #000000;
      }

      th{
        font-weight: 520;
        font-size: 14px;
        background-color: #74cfae;
        color: #FFFFFF;
        padding: 5px 10px;
        border:solid 2px #000000;
        font-family:sans-serif;
      }

      td{
        font-size: 15px;
        border: solid 2px #000000;
        color: #000000;
        padding: 5px 10px;
        font-family:sans-serif;
      }

      .deficit{
        color: red;
      }

      .the-black{
        color: blue;
      }

      .table{
        display: table;
        margin: 5px;
        padding: 20px;
      }

      .table-row{
        display: table-row;
      }

      .table-item-name{
        font-weight: 520;
        font-size: 15px;
        background-color: #74cfae;
        color: #FFFFFF;
        border:solid 2px #000000;
        border-bottom: solid 0px #000000;
        padding: 10px;
        display: table-cell;
        width: 20%;
        font-family:sans-serif;
      }

      .table-item-name-blind{
        font-weight: 520;
        font-size: 15px;
        background-color: #74cfae;
        color: #74cfae;
        border:solid 2px #000000;
        border-bottom: solid 0px #000000;
        border-left: solid 0px #000000;
        padding: 10px;
        display: table-cell;
      }

      .table-item-number{
        font-weight: 400;
        font-size: 15px;
        background-color: #f5f8fa;
        color: #000000;
        border:solid 2px #000000;
        border-right: solid 0px #000000;
        padding: 10px;
        display: table-cell;
        font-family:sans-serif;
      }

      .delete{
        display: table-cell;
        border:solid 2px #000000;
        border-left: solid 0px #000000;
        padding: 10px;
        text-align: right;
        width: 25%;
      }

      .btn-custom{
        margin: 10px;
        margin-left: 25px;
        padding: 10px;
        font-size: 15px;
        color: #ffffff;
      	background-color: #74cfae;
      }

      .btn-custom:hover{
        background-color: #32cde5;
        border-color: #285e8e;
      }

      .btn-set{
        width: 60px;
        margin: 3px;
        padding: 3px;
        font-size: 15px;
        color: #ffffff;
      	background-color: #74cfae;
      }

      .btn-set:hover{
        background-color: #32cde5;
        border-color: #285e8e;
      }

    </style>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Portfolio Viewer
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('会員登録') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
