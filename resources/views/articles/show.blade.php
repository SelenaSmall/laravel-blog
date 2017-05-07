@extends('layouts.app')

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <h1>{{ $article->title }}</h1>
        Written by {{$article->author}}

        <p>{{ $article->body }}</p>

        @if (Auth::user())
            <a href="{{ url('articles/'.$article->id.'/edit') }}">edit Article</a>

            <form action="/articles/{{ $article->id }}" method="POST" style="float:right">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-flat btn-danger">Delete Article</button>
            </form>
        @endif

        <hr>
        <div>
            <a href="{{ url('/') }}">Back</a>
        </div>
    </div>
@endsection