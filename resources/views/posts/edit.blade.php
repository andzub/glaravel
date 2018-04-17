@extends('layouts.app') 

@section('content')
    <h2>Edit a post</h2>
    <form action="/{{ $post->id }}" method="POST">
        {{ csrf_field() }}
        {!! method_field('patch') !!}

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ $post->title }}" id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" required> 
            
            @if ($errors->has('title'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="body">Description</label>
            <textarea name="body" id="body" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" cols="30" rows="10" required>{{ $post->body }}</textarea>

            @if ($errors->has('body'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('body') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
@endsection