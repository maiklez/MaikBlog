<?php

namespace Maiklez\MaikBlog\Http\Controllers;

use Maiklez\MaikBlog\Models\Post;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Maiklez\MaikBlog\Models\Comment;
use Maiklez\MaikBlog\Models\Maiklez\MaikBlog\Models;

class MaikBlogController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth', ['except' => ['blogView', 'show']]);
	}
	
	/**
	 * Display a list of all blog post.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function blogView(Request $request)
	{
		//dd(\Config::get("maikblog.message"));
		$posts = Post::all();
		
		return view('maikblog::maikblog', [
	        'posts' => $posts,
	    ]);
	}
	
	/**
	 * Display a list of all blog post to admin.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function index(Request $request)
	{
		
		$posts = Post::all();
	
		return view('maikblog::table', [
				'posts' => $posts,
		]);
	}
	
	/**
	 * Create a blog post view.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function create(Request $request)
	{
		
		return view('maikblog::create', [
				
		]);
	}
	
	/**
	 * Create a new task.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		
		$this->validate($request, Post::storeRules());
		
		Post::create(Post::storeAttributes($request));
		
		return redirect(route('blog'));
	}
	
	/**
	 * show the given task.
	 *
	 * @param  Request  $request
	 * @param  Task  $task
	 * @return Response
	 */
	public function show(Request $request, Post $post)
	{
		
		return view('maikblog::show', [
				'post' => $post,
				'comments' => $post->comments,
		]);
	}
	
	
	/**
	 * Edit the given task.
	 *
	 * @param  Request  $request
	 * @param  Task  $task
	 * @return Response
	 */
	public function edit(Request $request, Post $post)
	{
		
		return view('maikblog::edit', [
	        'post' => $post,
	    ]);
	}
	
	/**
	 * Update the given task.
	 *
	 * @param  Request  $request
	 * @param  Task  $task
	 * @return Response
	 */
	public function addComment(Request $request, $post_id)
	{
		$post = Post::find($post_id);
		$comment = new Comment();
		$comment->on_post = $post_id;
		$comment->from_user=Auth::user()->id;
		$comment->body = $request->input('body');
		
		$post->comments()->save($comment);
	
		return redirect(route('post.show', [
				'post' => $post,
				'comments' => $post->comments,
		]))->with('success', 'Comment added!');
	}
	
	/**
	 * Update the given task.
	 *
	 * @param  Request  $request
	 * @param  Task  $task
	 * @return Response
	 */
	public function update(Request $request, Post $post)
	{
		$this->authorize('admin',  Auth::user());
	
		$post->update(Post::storeAttributes($request));
		
		return redirect(route('post.edit', $post))->with('success', 'Profile updated!');
	}
	
	/**
	 * Destroy the given task.
	 *
	 * @param  Request  $request
	 * @param  Task  $task
	 * @return Response
	 */
	public function destroy(Request $request, Post $post)
	{
		$this->authorize('admin',  Auth::user());
	
		$post->delete();
	
		return redirect(route('blog'));
	}
}
