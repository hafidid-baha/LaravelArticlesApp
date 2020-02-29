@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Create New Post</h1>
        <hr />
        <div class="div-12">
            {!! Form::open(['action'=>'PostsController@store','files'=>true]) !!}
                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '',['class'=>'form-control','placeholder'=>'Title','required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('body', '',['class'=>'form-control','placeholder'=>'Body','required'])}}
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