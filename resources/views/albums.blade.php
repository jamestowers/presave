@extends('app')

@section('title', 'Login')

@section('content')
    
    <ul>
    @foreach($albums as $album)
        <li>{{ $album->album->name }}</li>
    @endforeach
    </ul>
@stop