@extends('layouts.app')


@section('scripts')
	
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  	<script>tinymce.init({
  	  selector: 'textarea',
  	  height: 500,
  	  plugins: [
  	    'advlist autolink lists link image charmap print preview anchor',
  	    'searchreplace visualblocks code fullscreen',
  	    'insertdatetime media table contextmenu paste code'
  	  ],
  	  relative_urls: false,
  	  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  	  content_css: [
  	    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
  	    '//www.tinymce.com/css/codepen.min.css'
  	  ],
    	style_formats: [
    	  	              { title: 'Headers', items: [
    	  	                { title: 'h1', block: 'h1' },
    	  	                { title: 'h2', block: 'h2' },
    	  	                { title: 'h3', block: 'h3' },
    	  	                { title: 'h4', block: 'h4' },
    	  	                { title: 'h5', block: 'h5' },
    	  	                { title: 'h6', block: 'h6' }
    	  	              ] },

    	  	              { title: 'Blocks', items: [
    	  	                { title: 'p', block: 'p' },
    	  	                { title: 'div', block: 'div' },
    	  	                { title: 'terminal', block: 'p', classes: 'terminal' },
    	  	                { title: 'terminal2', inline: 'span', classes: 'terminal2' },
    	  	                { title: 'Codigo', block: 'pre', classes: 'prettyprint linenums' },
    	  	                { title: 'pre', block: 'pre' }
    	  	              ] },

    	  	              { title: 'Containers', items: [
    	  	                { title: 'section', block: 'section', wrapper: true, merge_siblings: false },
    	  	                { title: 'article', block: 'article', wrapper: true, merge_siblings: false },
    	  	                { title: 'blockquote', block: 'blockquote', wrapper: true },
    	  	                { title: 'hgroup', block: 'hgroup', wrapper: true },
    	  	                { title: 'aside', block: 'aside', wrapper: true },
    	  	                { title: 'figure', block: 'figure', wrapper: true }
    	  	              ] }
    	  	            ]
    	  	});</script>
@endsection


@section('content')
<div class="container">
    
    <div class="row">    
		<div class="panel panel-post">
			<div class="panel-heading">Add New Post</div>
	            
		    <div class="panel-body">
		        <!-- Display Validation Errors -->
		       	<div class="form-group">
		       		@include('partials.notifications')
		       	</div>
		       
				<form action="{{ route('post.store') }}" method="POST" class="form-horizontal">
		        	{!! csrf_field() !!}
		        	
		        	
		        	<!-- Task Name -->
            <div class="form-group">
                <label for="post-title" class="col-sm-3 control-label">Post title</label>

                <div class="col-sm-6">                    
		    			{!! Form::text('title', old('title', isset($post) ? $post->title : null), 
		    													array('class'=>'form-control', 'id'=>'post-title',
		    													'placeholder'=>'Title',
		    													'style'=>'')) !!}
		    			{!! $errors->first('title', '<span class="help-block">:message</span>') !!}									   
                </div>                
            </div>
            
            <div class="form-group">
                <label for="post-title" class="col-sm-3 control-label">Categories</label>

                <div class="col-sm-6">                    
		    			{!! Form::text('categories', old('categories', isset($categories) ? $categories : null), 
		    													array('class'=>'form-control', 'id'=>'post-categories',
		    													'placeholder'=>'Categories',
		    													'style'=>'')) !!}
		    			{!! $errors->first('categories', '<span class="help-block">:message</span>') !!}									   
                </div>                
            </div>
            
            
            <div class="form-group">
                <label for="post-title" class="col-sm-3 control-label">Tags</label>

                <div class="col-sm-6">                    
		    			{!! Form::text('tags', old('tags', isset($tags) ? $tags : null), 
		    													array('class'=>'form-control', 'id'=>'post-tags',
		    													'placeholder'=>'Tags',
		    													'style'=>'')) !!}
		    			{!! $errors->first('tags', '<span class="help-block">:message</span>') !!}									   
                </div>                
            </div>
            
            
            <div class="form-group">
            
                <div class="col-sm-12">                    
		    			
	                	<textarea name="body" rows="50" cols="80" >{!! old("body") !!}</textarea>

		    			{!! $errors->first('body', '<span class="help-block">:message</span>') !!}									   
                </div>                
            </div>
            
            
		        	
		        	<!-- Add Task Button -->
		            <div class="form-group">
		                <div class="col-sm-offset-3 col-sm-6">
		                    <button type="submit" class="btn btn-default" name="publish" value="publish">
		                        <i class="fa fa-plus"></i> Publish
		                    </button>
		                    
		                    <button type="submit" class="btn btn-default" name="save" value="save">
		                        <i class="fa fa-plus"></i> Save Draft
		                    </button>
		                </div>
		            </div>
		        </form>
		    </div>
		</div>
	
	</div>
	</div>

@endsection