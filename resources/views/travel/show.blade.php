@extends('layouts.app')

@section('content')
    <a href="/travel" class="btn btn-default">Go back</a>
    <h1>{{$travel->title}}</h1>
    <img style="width:100%" src="/storage/cover_image/{{$travel->cover_image}}">
    <br><br>
    <div>
        {!!$travel->body!!}
    </div>
    <hr>
    <small>Written on {{$travel->created_at}} by {{$travel->user->name}}</small>
    <hr>
    @if(!Auth::guest())
      @if(Auth::user()->id == 1)
          <a href="/travel/{{$travel->id}}/edit" class="btn btn-default">Edit</a>
          {!!Form::open(['action' => ['TravelController@destroy', $travel->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
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
