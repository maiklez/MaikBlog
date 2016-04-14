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
    
    /**
     * Get all of the tasks for the user.
     */
    public function tags()
    {
    	return $this->hasMany(Tag::class, 'post_tags', 'post', 'tag');
    }
    
    /**
     * Get all of the tasks for the user.
     */
    public function categories()
    {
    	return $this->hasMany(Category::class, 'post_categories', 'post', 'category');
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
    
    public function saveCategories ($categories){
    
    	$save_etis = [];
    	foreach ($categories as $eti){
    		$eti = trim($eti);
    		$eti = html_entity_decode($eti);
    			
    		$tmp = Category::where('name', 'like', $eti)->get()->first();
    		if (is_null($tmp)){
    			$tmp = new Category(['name' => $eti]);
    		}
    		array_push($save_etis, $tmp);
    	}
    	if(count($save_etis)>0) $this->categories()->sync($save_etis);
    }
    
    
    
    public function saveTags ($tags){
    
    	$save_etis = [];
    	foreach ($tags as $eti){
    		$eti = trim($eti);
    		$eti = html_entity_decode($eti);
    		 
    		$tmp = Tag::where('name', 'like', $eti)->get()->first();
    		if (is_null($tmp)){
    			$tmp = new Tag(['name' => $eti]);
    		}
    		array_push($save_etis, $tmp);
    	}
    	if(count($save_etis)>0) $this->tags()->sync($save_etis);
    }
    
}
