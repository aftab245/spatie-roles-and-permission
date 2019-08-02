@extends('layouts.app')

@section('title', '| Edit Post')

@section('content')
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Edit Post</h1>
        <hr>
            {{ Form::model($post, array('route' => array('posts.update', $post->id), 'method' => 'PUT','files'=>'true')) }}
            <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}<br>

            {{-- {{ Form::label('body', 'Post Body') }}
            {{ Form::textarea('body', null, array('class' => 'form-control','rows'=>'4')) }}<br> --}}

            {{ Form::label('image', 'Image') }}
            {{ Form::file('image', array('class' => 'form-control')) }}
            <img src="/storage/images/{{ $post->image }}" style="height:120px;width:120px"><br>
            {{ Form::submit('Update post ( '.$post->title.' )', array('class' => 'btn btn-primary')) }}
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection