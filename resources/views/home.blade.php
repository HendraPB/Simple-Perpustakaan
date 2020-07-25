@extends('layout')

@section('custom_content_header')
<h1>Halo {{ Auth::user()->name }}</h1>
@stop

@section('custom_content')
<div id="app">
    
</div>
@stop

@section('custom_footer')
@stop

@section('custom_css')
@stop

@section('custom_js')
@stop
