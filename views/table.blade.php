@extends('layouts.app')


@section('content')
	
	<a class="btn btn-warning fa fa-plus" href={!! route('post.create') !!}><span> Create new post</span></a>
	<!-- Current Posts -->
    @if (count($posts) > 0)
        <div class="container">
    	<div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Posts
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Users</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $post->title }}</div>
                                </td>
								<td class="table-text">
                                    <div>{!!  $post->body !!}</div>
                                </td>
                                
                                <td class="table-text">
                                    <div>{{ $post->author->name }}</div>
                                    
                                </td>
                                
                                <td>
                                     <div	><a class="btn btn-default glyphicon glyphicon-eye-open" href={!! route('post.show', $post->id) !!}>
                                     <span>Show</span></a>
                                     
                                     <a class="btn btn-warning glyphicon glyphicon-edit" href={!! route('post.edit', $post->id) !!}>
                                     <span>Edit</span></a>

                                     
                                     @include('partials.delete_button', [$url=route('post.destroy', $post->id), $id = 'delete-post-'.$post->id])
                                     
                                     </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        </div>
    @endif

@stop