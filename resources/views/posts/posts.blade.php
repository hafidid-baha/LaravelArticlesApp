@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Posts</h1>
        
        <div class="row">
            @if (count($posts)>0)
                @foreach ($posts as $post)
                    <div class="col-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="/storage/postsImages/{{$post->image}}" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{ mb_strimwidth($post->body, 0, 50, "...")}}</p>
                            <a href="/posts/{{$post->id}}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection