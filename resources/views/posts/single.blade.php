@extends('layouts.app')

@section('content')
    <div class="container  mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="/posts" class="btn btn-success mb-2">Go Back</a>
                <h1>{{$post->title}}</h1>
                <small class="mt-4 mb-4 d-block">
                    {{$post->created_at}} &nbsp; &nbsp; &nbsp; By : {{ $post->user->name }}
                </small>
                <div class="col-6">
                    <img class="img-fluid" src="/storage/postsImages/{{$post->image}}" />
                </div>
                <div class="">
                    {{$post->body}}
                </div>
            </div>
        </div>
    </div>
@endsection