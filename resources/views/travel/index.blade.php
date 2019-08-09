@extends('layouts.app')

@section('content')
    <h1>Paket Travel</h1>
    @if(count($travels) > 0)
        @foreach($travels as $travel)
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="storage/cover_image/{{$travel->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/travel/{{$travel->id}}">{{$travel->title}}</a></h3>
                        <small>Written on {{$travel->created_at}} by {{$travel->user->name}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$travels->links()}}
    @else
        <p>No post found</p>
    @endif
@endsection
