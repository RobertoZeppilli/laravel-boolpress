@extends('layouts.app')

@section('content')
    <section class="py-5 text-center">
        <h1>404</h1>
        <h2>Not Found</h2>
        <p class="mt-4">
            Oops, qualcosa è andato storto
            <br>La risorsa che stavi cercando non è disponibile.
        </p>
        <a class="btn btn-secondary text-light" href="{{ route('admin.posts.index') }}">
            <i class="fas fa-arrow-left"></i>
        </a>
    </section>
@endsection