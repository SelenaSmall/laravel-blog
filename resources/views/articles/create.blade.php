@extends('layouts.app')
@section('content')
    <div class="col-md-6 col-md-offset-3">
        <h1>Create a new Article</h1>
        <div class="form-group">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/articles') }}">
                    {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

                    <label for="title" class="col-md-8">Title</label>
                    <div class="col-md-10">
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
                        @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">

                    <label for="body" class="col-md-8">Body</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name="body" value="{{ old('body') }}">
                        </textarea>

                        @if ($errors->has('body'))
                        <span class="help-block">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4" style="text-align: right">
                        <button type="submit" class="btn btn-primary">
                                Post Article
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <a href="{{ url('/') }}">Back</a>
        </div>
    </div>
@endsection