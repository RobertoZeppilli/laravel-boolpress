@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        <div class="row my-3">
            <div class="col-12">
                <div>
                    <h2>{{ $post->title }}</h2>
                </div>
                <div class="d-flex flex-column align-items-start">
                    @if ($post->category)
                        <a href="{{ route('admin.categories.show', $post->category->id) }}" class="badge badge-info text-light mb-2">
                            {{ $post->category->name }}
                        </a> 
                    @else
                        <span class="badge badge-secondary mb-2">N/B</span>
                    @endif
                    @if (count($post->tags) > 0) 
                        <div class="d-flex">
                            @foreach ($post->tags as $tag)
                                <a class="badge badge-pill badge-warning text-white mr-2" 
                                href="{{ route('admin.tags.show', $tag->id) }}">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @else 
                        <span class="badge badge-pill badge-secondary text-light">No tags</span>    
                    @endif
                    @if ($post->cover)
                        <div class="my-3">
                            <img class="img-fluid" src="{{ asset('storage/'.$post->cover) }}" alt="{{ $post->title }}">
                        </div>
                    @endif
                </div>
                <p class="{{ (!$post->cover) ? 'mt-3' : '' }}">{{ $post->body }}</p>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <a class="btn btn-success" href="{{ route('admin.posts.edit', $post->id) }}">
                <i class="fas fa-pencil-alt text-light"></i>
            </a>
        </div>
    </div>
@endsection