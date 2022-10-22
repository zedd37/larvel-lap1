@extends('layouts.app')

@section('title') create @endsection
@section('content')
<div class="card">
    <div class="card-header">
    {{$post['header']}}
    </div>
    <div class="card-body">
        <h5 class="card-title"><b>title:- </b>{{$post['title']}}</h5>
        <p class="card-text">Description:- <br>{{$post['Description']}}</p>
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
    {{$post['header']}}
    </div>
    <div class="card-body">
    <h5 class="card-title"><b>title:- </b>{{$post['title']}}</h5>
    <p class="card-text">Description:- <br>{{$post['Description']}}</p>
    </div>
</div>
@endsection
