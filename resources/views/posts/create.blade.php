@extends('layouts.app')

@section('title', '| Create New Post')

@section('content')
    <a href="{{ route('posts.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to dashboard</a>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">

        <h1>Create New Post</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'posts.store','files'=>'true')) }}

        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('image', 'Image') }}
            {{ Form::file('image', array('class' => 'form-control')) }}
            <br>

            {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

@endsection