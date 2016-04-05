<?php

namespace Maiklez\MaikBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\User;

class Comment extends Model
{	
	protected $table="comments";
     
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['on_post', 'from_user', 'body'];
    
    
    public function author(){
    	return $this->belongsTo(User::class, 'from_user');
    }
    
    public function post(){
    	return $this->belongsTo(Post::class, 'on_post');
    }
    
    public static function  storeRules(){
    	return [
				'name' => 'required|max:255',
		];
    }
    
    public static function  storeAttributes(Request $request){
    	return [
				'name' => $request->name,
				'description' => $request->description,
		];
    }
}
