@extends('layouts.app')

@section('content')
    <div class="row">

        <!-- if there is no session then display form -->
        @if (!session('name'))
            <div class="col-md-12">
                <div class="card" style="margin-bottom:20px">
                    <div class="card-header text-center"><h4>Login</h4></div>
    
                    <div class="card-body">
                        <form method="POST" action="/">
                            @csrf
    
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Display the posts -->
        @foreach($posts as $post)
            <div class="col-md-6">
                <div class="jumbotron">
                    <h2><a href="/{{ $post->id }}">{{ $post->title }}</a></h2>
                    <p>Author name: <strong>{{ $post->author['name'] }}</strong></p>
                    <p>Creation date: <strong>{{ date('Y-m-d', strtotime($post->created_at)) }}</strong></p>
                    <p>{{ $post->body }}</p>
                    <p><a href="/{{ $post->id }}" class="btn btn-primary">Read more</a></p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination 5 items -->
    <div class="text-center">
        {!! $posts->links(); !!}
    </div>
@endsection
