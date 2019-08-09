@extends('layouts.app')

@section('content')
    <h1>Detail Pesanan</h1>
    {!! Form::open(['action' => ['OrderController@update', $order->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      <h3><center>1x24 jam tidak melakukan pembayaran pesanan batal secara otomatis</center></h3>
      <input type="hidden" name="title" value="{{$order->title}}">
      <input type="hidden" name="order_status" value="Sudah dibayar">
      {{Form::hidden('_method', 'PUT')}}
      {{Form::submit('Bayar', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
