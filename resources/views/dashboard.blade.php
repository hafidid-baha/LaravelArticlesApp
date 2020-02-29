@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12 mt-4 mb-4">
                            <a href="/posts/create" class="btn btn-success">Create New Post</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-stripped mt-2">
                <tr>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-warning d-inline-block">Edite</a></td>
                        <td>
                            {!! Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'Delete','class'=>'d-inline-block']) !!}
                                {{ Form::submit('Delete',['class'=>'btn btn-warning d-inline-block']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
