@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="panel-body">
                    <a href="/tour/create" class="btn btn-primary">Create Tour</a>
                    <a href="/travel/create" class="btn btn-primary">Create Travel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
