<?php

namespace Maiklez\MaikBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Auth;
use App\User;
class Post extends Model
{	
	protected $table="posts";

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['author_id', 'title', 'body', 'slug'];
    
    protected $dates = ['published_at'];

    /**
     * Get all of the tasks for the user.
     */
    public function author()
    {
    	return $this->belongsTo(User::class);
    }
    
    /**
     * Get all of the tasks for the user.
     */
    public function comments()
    {
    	return $this->hasMany(Comment::class, 'on_post');
    }
    
    public static function  storeRules(){
    	return [
				'title' => 'required|max:255',
    			'body' => 'required',
		];
    }
    
    public static function  storeAttributes(Request $request){
    	return [
				'author_id'=> Auth::user()->id,
    			'title' => $request->title,
				'body' => $request->body,
    			'slug' => str_slug($request->title)
		];
    }
}
