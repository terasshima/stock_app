@extends('layouts.app')
<!-- 会員登録後のイメージ図。初めてログインしてもらった人に銘柄等入力してもらう !-->
@section('content')
  <h3>ポートフォリオ情報を入力してください！</h3>
  <br>
  <br>

  @if(count($errors) > 0)
  <p class="error-title">入力に問題があります！再入力してください。</p>
  @endif

  <div class="error-msg">
    @if($errors->has('principalToView'))
    {{$errors->first('principalToView')}}

    @elseif($errors->has('stock_codeToView'))
    {{$errors->first('stock_codeToView')}}

    @elseif($errors->has('cashToView'))
    {{$errors->first('cashToView')}}
    @endif
  </div>

  <form method="POST" action="/make/principal">
    {{ csrf_field() }}
    <div class="form-group">
      <div class="error-msg">
        @if($errors->has('principal'))
        {{$errors->first('principal')}}
        <br>
        @elseif($errors->has('usersPrincipal'))
        {{$errors->first('usersPrincipal')}}
        <br>
        @endif
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-1">
            <span class="item">投資元本:</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <input class="form-control{{ $errors->has('principal') ? ' is-invalid' : '' }}" type="text" name="principal" value="{{old('principal')}}">
          </div>
        </div>
          <button class="btn-set" type="submit">設定</button>
          @foreach($investmentPrincipal as $principal)
          <input type="hidden" name="usersPrincipal" value="{{$principal->user_id}}">
          @endforeach
      </div>
     </div>
   </div>
  </form>


  <form method="POST" action="/make/add">
    {{ csrf_field() }}

    <div class="form-group">
      <div class="error-msg">
        @if($errors->has('stock_code'))
        {{$errors->first('stock_code')}}
        <br>
        @endif
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-1">
            <span class="item">証券コード:</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <input class="form-control{{ $errors->has('stock_code') ? ' is-invalid' : '' }}" type="text" name="stock_code" value="{{old('stock_code')}}">
          </div>
        </div>


      <div class="error-msg">
        @if($errors->has('company_name'))
        <br>
        {{$errors->first('company_name')}}
        <br>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-1">
          <span class="item">銘柄名:</span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9">
          <input class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" type="text" name="company_name" value="{{old('company_name')}}">
        </div>
      </div>

      <div class="error-msg">
        @if($errors->has('stock_price'))
        <br>
        {{$errors->first('stock_price')}}
        <br>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-1">
          <span class="item">株価:</span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9">
          <input class="form-control{{ $errors->has('stock_price') ? ' is-invalid' : '' }}" type="text" name="stock_price" value="{{old('stock_price')}}">
        </div>
      </div>


      <div class="error-msg">
        @if($errors->has('holding_number'))
        <br>
        {{$errors->first('holding_number')}}
        <br>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-1">
          <span class="item">保有数:</span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9">
          <input class="form-control{{ $errors->has('holding_number') ? ' is-invalid' : '' }}" type="text" name="holding_number" value="{{old('holding_number')}}">
        </div>
      </div>

      <div class="error-msg">
        @if($errors->has('average_price'))
        <br>
        {{$errors->first('average_price')}}
        <br>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-1">
          <span class="item">平均取得価額:</span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9">
          <input class="form-control{{ $errors->has('average_price') ? ' is-invalid' : '' }}" type="text" name="average_price" value="{{old('average_price')}}">
        </div>
      </div>

      <button class="btn-set" type="submit">追加</button>
    </div>
  </div>
</form>

  <form method="post" action="/make/cash">
    {{ csrf_field() }}
    <div class="form-group">
      <div class="error-msg">
        @if($errors->has('cash'))
        {{$errors->first('cash')}}
        <br>
        @elseif($errors->has('usersCash'))
        {{$errors->first('usersCash')}}
        <br>
        @endif
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-1">
            <span class="item">現金(CP):</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <input class="form-control{{ $errors->has('cash') ? ' is-invalid' : '' }}" type="text" name="cash" value="{{old('cash')}}">
          </div>
        </div>

        <button class="btn-set" type="submit">設定</button>
          @foreach($cashPosition as $cash)
            <input type="hidden" name="usersCash" value="{{$cash->user_id}}">
          @endforeach
      </div>
    </div>
  </form>
  <br>

<div class="table-responsive">
  <div class="text-nowrap">
    <div class="table">
      @if(count($investmentPrincipal) > 0)
        <div class="table-row">
          <div class="table-item-name" style="border-right:0px;">
            投資元本
          </div>
          <div class="table-item-name-blind">
            .
          </div>
        </div>
        <div class="table-row">
          <div class="table-item-number">
            @foreach($investmentPrincipal as $principal)
              {{number_format($principal->principal)}}
            @endforeach
          </div>
          <div class="delete">
            <form action="/make/principal/{{$principal->id}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

              <button type="submit" class="btn btn-danger">
                  <i class="fa fa-trash"></i>削除
              </button>
            </form>
          </div>
        </div>
      @endif

    @if(count($items) > 0)
      <div class="table-row">
        <div class="table-item-name">
          証券コード
        </div>
        <div class="table-item-name" style="border-left:0px;">
          銘柄名
        </div>
        <div class="table-item-name" style="border-left:0px;">
          株価
        </div>
        <div class="table-item-name" style="border-left:0px;">
          保有数
        </div>
        <div class="table-item-name" style="border-left:0px; border-right:0px;">
          平均取得単価
        </div>
        <div class="table-item-name-blind">
          .
        </div>
      </div>
      @foreach ($items as $item)
      <div class="table-row">
        <div class="table-item-number">
            {{$item->stock_code}}
        </div>
        <div class="table-item-number">
            {{$item->company_name}}
        </div>
        <div class="table-item-number">
            {{number_format($item->stock_price)}}
        </div>
        <div class="table-item-number">
            {{number_format($item->holding_number)}}
        </div>
        <div class="table-item-number">
            {{number_format($item->average_price)}}
        </div>
        <div class="delete">
          <form action="/make/{{$item->id}}" method="POST">
  					{{ csrf_field() }}
  			    {{ method_field('DELETE') }}

  				<button type="submit" class="btn btn-danger">
  						<i class="fa fa-trash"></i>削除
  				</button>
  					</form>
        </div>
      </div>
      @endforeach
      @endif

      @if (count($cashPosition) > 0)
        <div class="table-row">
          <div class="table-item-name" style="border-right:0px;">
            現金(CP)
          </div>
          <div class="table-item-name-blind">
            .
          </div>
        </div>

        @foreach($cashPosition as $cash)
        <div class="table-row">
          <div class="table-item-number">
            {{number_format($cash->cash)}}
          </div>
          <div class="delete">
            <form action="/make/cash/{{$cash->id}}" method="POST">
      					{{ csrf_field() }}
      			    {{ method_field('DELETE') }}

      				<button type="submit" class="btn btn-danger">
      						<i class="fa fa-trash"></i>削除
      				</button>
      			</form>
          </div>
        </div>
        @endforeach
      @endif
    </div>
  </div>
</div>
      <form action="/view" method="POST">
        {{ csrf_field() }}
        <input class="btn-custom" type="submit" value="ポートフォリオ作成">
        @foreach($investmentPrincipal as $principal)
          <input type="hidden" name="principalToView" value="{{$principal->principal}}">
        @endforeach

        @foreach($items as $item)
          <input type="hidden" name="stock_codeToView" value="{{$item->stock_code}}">
        @endforeach

        @foreach($cashPosition as $cash)
          <input type="hidden" name="cashToView" value="{{$cash->cash}}">
        @endforeach
      </form>

@endsection
