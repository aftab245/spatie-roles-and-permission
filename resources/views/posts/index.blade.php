@extends('layouts.app')
@section('title', '| posts')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>{{ $posts->count() }}{{ $posts->count()==1?' Post ' :' Posts'}} </h3></div>
                    <div class="panel-heading">Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</div>
                    @foreach ($posts as $post)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('posts.show', $post->id ) }}"><b>{{ $post->title }}</b><br>
                                    {{-- <p class="teaser">
                                       {{  str_limit($post->body, 100) }} {{-- Limit teaser to 100 characters --}}
                                    {{-- </p> --}}
                                    <img src="/storage/images/{{ $post->image }}" style="height:50px;width:50px" class="img-circle">
                                </a>
                            </li>
                            Created at:{{ $post->updated_at->format('F d, Y h:ia') }}
                            <hr>
                        </div>
                    @endforeach
                    </div>
                    <div class="text-center">
                        {!! $posts->links() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection