@extends('layouts.app')

@section('content')
    <h1>Pesanan saya</h1>
    @if(count($orders) > 0)
        @foreach($orders as $order)
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        @if(!Auth::guest())
                          @if(Auth::user()->id == $order->user_id)
                            <h3><a href="/order/{{$order->id}}">Pesanan {{$order->id}}</a></h3>
                            @if($order->order_status == "Belum dibayar")
                              {!!Form::open(['action' => ['OrderController@destroy', $order->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                  {{Form::hidden('_method', 'DELETE')}}
                                  {{Form::submit('Cancel', ['class' => 'btn btn-danger'])}}
                              {!!Form::close()!!}
                            @else
                              <button type="button" class="btn btn-danger" disabled>Cancel</button>
                            @endif
                          @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        {{$orders->links()}}
    @endif
@endsection
