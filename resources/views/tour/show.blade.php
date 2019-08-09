@extends('layouts.app')

@section('content')
    <a href="/tour" class="btn btn-default">Go back</a>
    <h1>{{$tour->title}}</h1>
    <img style="width:100%" src="/storage/cover_image/{{$tour->cover_image}}">
    <br><br>
    <div>
        {!!$tour->body!!}
    </div>
    <hr>
    <small>Written on {{$tour->created_at}} by {{$tour->user->name}}</small>
    <hr>
    @if(!Auth::guest())
      @if(Auth::user()->id == 1)
          <a href="/tour/{{$tour->id}}/edit" class="btn btn-default">Edit</a>
          {!!Form::open(['action' => ['TourController@destroy', $tour->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
          {!!Form::close()!!}
      @else
          <center>
            <button type="button" class="btn btn-primary" onclick="window.location='{{url("/order/create")}}'">Pesan</button>
          </center>
      @endif
    @endif
@endsection
