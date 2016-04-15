<?php namespace	Maiklez\MaikBlog;
/**
 * 
 * @author maiklez <maik.ledzep@gmail>
 */
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class MaikBlogServiceProvider extends ServiceProvider{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;
	public function boot()
	{
		$this->loadViewsFrom(realpath(__DIR__.'/../views'), 'maikblog');
		
		$this->publishes([
				realpath(__DIR__.'/../views') => base_path('resources/views/vendor/maikblog'),
		]);
		
		$this->setupRoutes($this->app->router);
		
		// this  for conig
		$this->publishes([
				__DIR__.'/config/maikblog.php' => config_path('maikblog.php'),
		], 'config');
		
		//this for migrations
		$this->publishes([
				__DIR__.'/database/migrations/' => database_path('migrations')
		], 'migrations');
		
		//this for css and js
		$this->publishes([
				realpath(__DIR__.'/../assets') => public_path('maiklez/maikblog'),
		], 'public');
		
		\Validator::extend('tag_rule', function ($attribute, $value, $parameters)
		{
			$tags = explode(',', $value);
			// remove empty items from array
			$tags = array_filter($tags);
			// trim all the items in array
			$tags =array_map('trim', $tags);
		
			\Debugbar::info($tags);
			foreach ($tags as $tag){
				if($tag === "") return false;
			}
		
			return true;
		});
	}
	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function setupRoutes(Router $router)
	{
		$router->group(['namespace' => 'Maiklez\MaikBlog\Http\Controllers'], function($router)
		{
			require __DIR__.'/Http/routes.php';
		});
	}
	public function register()
	{
		$this->registerContact();
		config([
				'config/maikblog.php',
		]);
	}
	private function registerContact()
	{
		$this->app->bind('maikblog',function($app){
			return new MaikBlog($app);
		});
	}
}