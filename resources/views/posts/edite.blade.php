@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edite Post</h1>
        <hr />
        <div class="div-12">
            {!! Form::open(['action'=>['PostsController@update',$post->id],'method'=>'PUT','files'=>true]) !!}
                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', $post->title ,['class'=>'form-control','placeholder'=>'Title','required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('body', $post->body,['class'=>'form-control','placeholder'=>'Body','required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('image', 'Post Image')}}
                    {{Form::file('image')}}
                </div>
                <div class="form-group">
                    {{Form::submit('Add The Post',['class'=>'btn btn-primary'])}}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection