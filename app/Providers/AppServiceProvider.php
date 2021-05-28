<?php

namespace App\Providers;

use App\Category;
use App\Post;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // pass $category to View (layout)
        view()->composer('categories.index', function ($view){
            $categories = Category::withDepth()
                ->with('ancestors')
                ->get();
            $view->with('categories', $categories);
        });

        view()->composer('posts.countLatestPost', function ($view){
            $posts = Post::whereDoesntHave('readBy', function ($q){
                $q->where('user_id', auth()->id());
            })->whereNotIn('user_id', [auth()->id()])
                ->get();
            $view->with('posts',$posts);
        });

    }
}
