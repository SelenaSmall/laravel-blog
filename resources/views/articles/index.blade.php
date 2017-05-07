@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading text-center"><h1>Articles</h1></div>
                    <div class="panel-body">

                        <ul class="all-blogs">
                            @foreach ($articles as $article)
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="http://placehold.it/200x100" alt="...">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="/articles/{{ $article->id }}">
                                            {{ $article->title }}
                                        </a></h4>
                                    <p class="author">Written by {{ $article->author }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
