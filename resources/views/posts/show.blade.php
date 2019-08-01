@extends('layouts.app')

@section('title', '| View Post')

@section('content')

<div class="container">
    <div class="col-lg-6 col-lg-offset-3">
    <h1>{{ $post->title }}</h1>
    <hr>
    <img src="/storage/images/{{ $post->image }}" style="height:400px;width:400px">
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $post->id] ]) !!}
    <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
    @can('Edit Post')
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan

    {{-- <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info" role="button">Edit</a> --}}
    {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
    
    @can('Delete Post')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}
    </div>
</div>

@endsection
