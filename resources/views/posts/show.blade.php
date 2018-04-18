@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="blog-post">
                <h2>{{ $post->title }}</h2>
                <p>Author name: <strong>{{ $post->author['name'] }}</strong></p>
                <p>Creation date: <strong>{{ date('Y-m-d', strtotime($post->created_at)) }}</strong></p>
                <p>{{ $post->body }}</p>
                
                <!-- if the session is equal to the user name, then display additional buttons to edit and delete -->
                @if (Auth::user()->id == $post->author['id'])
                    <p><a href="/edit/{{ $post->id }}" class="btn btn-warning">Edit</a></p>
                    <form action="/delete/{{ $post->id }}" method="POST">
                        {{ csrf_field() }}
                        {!! method_field('delete') !!}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection