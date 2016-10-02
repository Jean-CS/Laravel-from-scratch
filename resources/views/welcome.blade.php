@extends('layout')

@section('content')

    @if (Session::has('status'))
        <h3>{{ Session::get('status') }}</h3>
    @endif
    
    <h1>The Welcome Page</h1>

@stop
