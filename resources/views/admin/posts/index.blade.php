@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="posts-header d-flex justify-content-between align-items-center my-3">
            <h2>Posts Index</h2>
            <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">New Post</a>
        </div>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>
                            <a class="btn btn-success text-dark" href="{{ route('admin.posts.show', $post->id) }}">
                                Show
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onSubmit="return confirm('Are you sure you want to delete {{ $post->title }}?')">

                                @csrf
                                @method('DELETE')
                                
                                <button class="btn btn-danger text-dark" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{ $posts->links() }}</div>
    </div>
@endsection