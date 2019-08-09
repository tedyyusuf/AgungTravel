@extends('layouts.app')

@section('content')
    <h1>Paket Tour</h1>
    @if(count($tours) > 0)
        @foreach($tours as $tour)
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="storage/cover_image/{{$tour->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/tour/{{$tour->id}}">{{$tour->title}}</a></h3>
                        <small>Written on {{$tour->created_at}} by {{$tour->user->name}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$tours->links()}}
    @else
        <p>No post found</p>
    @endif
@endsection
