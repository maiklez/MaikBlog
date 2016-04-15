<?php

namespace Maiklez\MaikBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Auth;
class Tag extends Model
{	
	protected $table="tags";

	public $timestamps = false;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

/**
     * Get all posts.
     */
    public function posts()
    {
    	return $this->hasMany(Post::class, 'post_tags', 'tag', 'post');
    }
    
    public static function  storeRules(){
    	return [
				'tags' => 'required|max:255|tag_rule',
    			
		];
    }
    
    public function messages() {
    	return [
    			'validation.tag_rule' => 'The :attribute must have between :min and :max items.'];
    
    }
    
    public static function  storeAttributes(Request $request){
    	return [
				
		];
    }
}
