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
    	return $this->hasMany(Post::class, 'post_categories', 'category', 'post');
    }
    
    public static function  storeRules(){
    	return [
				'categories' => 'required|max:255',
    			
		];
    }
    
    public static function  storeAttributes(Request $request){
    	return [
				
		];
    }
}
