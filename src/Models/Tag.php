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
    	return $this->belongsToMany(Post::class, 'post_tags', 'tag', 'post');
    }
    
    // additional helper relation for the count
    public function postCount()
    {
    	return $this->posts()
    	->selectRaw('count(posts.id) as aggregate')
    	->groupBy('tag')
    	;
    }
    
    // accessor for easier fetching the count
    public function getPostCountAttribute()
    {
    	if ( ! array_key_exists('postCount', $this->relations)) $this->load('postCount');
    
    	$related = $this->getRelation('postCount')->first();
    
    	return ($related) ? $related->aggregate : 0;
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
