@extends('app')

@section('title', $campaign->album_title)

@section('content')

    <router-view :campaign="{{ $campaign }}"></router-view>

@stop


