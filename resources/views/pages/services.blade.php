@extends('layouts.app')
@section('content')

    <h1>{{$title}}</h1>
    <p> services list </p>
    @if(count($services) > 0)
        <ul>
        @foreach ($services as $s)
            <li>{{$s}}</li>
        @endforeach
        <ul>
    @endif
@endSection