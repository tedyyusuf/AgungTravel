@extends('layouts.app')

@section('content')
    <h1>Detail Pesanan</h1>
      <label for="titel">{{$order->title}}</label>
      <div class="form-row">
        <div class="form-group col-md-6">
          <input type="text" class="form-control" placeholder="{{$order->first_name}}" readonly>
        </div>
        <div class="form-group col-md-6">
          <input type="text" class="form-control" placeholder="{{$order->last_name}}" readonly>
        </div>
      </div>
      <label for="titel">Email</label>
      <div class="form-group">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="{{$order->email}}" readonly>
        </div>
      </div>
      <div class="form-group">
        <label for="inputPhone">Nomor Telpon / HP</label>
        <input type="tel" class="form-control" placeholder="{{$order->phone_number}}" readonly>
      </div>
      <div class="form-group">
        <label>Harga Paket</label>
        <input type="text" class="form-control" placeholder="{{$order->paket}}" readonly>
      </div>
      <label>Jadwal Keberangkatan</label>
      <div class="form-row">
        <div class="form-group col-md-4">
          <input type="number" class="form-control" placeholder="{{$order->day}}" readonly>
        </div>
        <div class="form-group col-md-4">
          <input type="number" class="form-control" placeholder="{{$order->month}}" readonly>
        </div>
        <div class="form-group col-md-4">
          <input type="number" class="form-control"placeholder="{{$order->year}}" readonly>
        </div>
      </div>
      <div class="form-group">
        <label>Jumlah Tamu</label>
        <input type="text" class="form-control" placeholder="{{$order->person}}" readonly>
      </div>
      <div class="form-group">
        <label>Transfer ke</label>
        <input type="text" class="form-control" placeholder="{{$order->payments}}" readonly>
      </div>
      <label>Total pembayaran</label>
      <div class="form-row">
        <div class="form-group col-md-5">
          <input type="text" class="form-control" placeholder="{{$order->paket}} x {{$order->person}}" readonly>
        </div>
        =
        <div class="form-group col-md-5">
          <input type="text" class="form-control" placeholder="{{$order->paket * $order->person}}" readonly>
        </div>
      </div>
      <div class="form-group">
        <label>Status Pembayaran</label>
        <input type="text" class="form-control" placeholder="{{$order->order_status}}" readonly>
      </div>
      @if(!Auth::guest())
        @if(Auth::user()->id == $order->user_id)
          @if($order->order_status == "Belum dibayar")
            <a href="/order/{{$order->id}}/edit" class="btn btn-primary" style="width:100%">Lakukan Pembayaran</a>
          @else
            <button type="button" class="btn btn-lg btn-primary" style="width:100%" disabled>Lakukan Pembayaran</button>
          @endif
        @endif
      @endif
@endsection
