@extends('layouts.app')


@section('title')
MaikBlog
@stop

@section('content')
	
	<!-- Current Posts -->
    @if (count($posts) > 0)
        <div class="container">
    	<div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                The Posts
            </div>

            <div class="panel-body">
                 @foreach ($posts as $post)
					@if($posts->first() != $post)
						<hr>
					@endif
					
					<div><h2>{{ $post->title }}</h2></div>
					<div>Published by {{ $post->author->name }}</div>
					<div>{!!  $post->body !!}</div>
					
					            
                 @endforeach
            </div>
        </div>
        </div>
        </div>
    @endif

@stop