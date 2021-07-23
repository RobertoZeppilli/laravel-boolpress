@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-3">Add a new post!</h2>
        <form action="{{ route('admin.posts.store') }}" method="POST" class="mt-3">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror @error('slug') is-invalid @enderror" id="title" placeholder="Add the title of your post..." name="title" value="{{ old('title') }}">

                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                @error('slug')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>
            <div>
                <label for="body">Body</label>
                <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" placeholder="Add the body of your post..." rows="4">{{ old('description') }}</textarea>

                @error('body')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary my-5">Add</button>
                <a class="btn btn-secondary text-light" href="{{ route('admin.posts.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection