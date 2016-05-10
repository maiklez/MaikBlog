@extends('layouts.app')


@section('content')
	
	<a class="btn btn-warning fa fa-plus" href={!! route('post.create') !!}><span> Create new post</span></a>
	<!-- Current Posts -->
    @if (count($posts) > 0)
        <div class="container">
    	<div class="row">
        <div class="panel panel-post">
            <div class="panel-heading">
                Current Posts
            </div>
			
			
			<div class="col-sm-12" style="display: flex;">
				<span>Categories: </span>
				@foreach( $best_cat as $tag )
				
				<div class="">
	               <span>{!! $tag->name !!} - {!! $tag->postCount !!} //</span>
	            </div>
				
				@endforeach
			</div>
			
			<div class="col-sm-12" style="display: flex;">
				<span>Tags: </span>
				@foreach( $best_tag as $tag )
				
				<div class="" >
	               <span>{!! $tag->name !!} - {!! $tag->postCount !!} //</span>
	           </div>
				
				@endforeach
			</div>
			
			
            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Title</th>
                        <th>Categories</th>
                        <th>Tags</th>
                        <th>Body</th>
                        <th>Author</th>
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
                                    <div>{{ $post->getCategoriesCommaSeparated() }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $post->getTagsCommaSeparated() }}</div>
                                </td>
								<td class="table-text">
                                    <div>{!!  substr($post->body,0, strpos($post->body, "</p>"))  !!}...<br>{{ $post->created_at }}</div>
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