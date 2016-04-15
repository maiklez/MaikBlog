<?php

namespace Maiklez\MaikBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Auth;
use App\User;
class Category extends Model
{	
	protected $table="categories";

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
    	return $this->belongsToMany(Post::class, 'post_categories', 'category', 'post');
    }
    
    // additional helper relation for the count
    public function postCount()
    {
    	return $this->posts()
    			->selectRaw('count(posts.id) as aggregate')
    			->groupBy('category');
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
				'categories' => 'required|max:255|tag_rule',
    			
		];
    }
    
    public static function  storeAttributes(Request $request){
    	return [
				
		];
    }
}
