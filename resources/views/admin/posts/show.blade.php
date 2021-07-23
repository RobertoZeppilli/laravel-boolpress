@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->body }}</p>
            </div>
        </div>
        <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Back</a>
    </div>
@endsection