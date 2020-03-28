<?php

namespace App\Providers;

use App\Models\Backend\Category;
use App\Models\Content;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\DB;
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
        //
        view()->share('category', Category::select('category_id','category')->get());

        view()->share('trending', Content::where('home',2)->leftJoin('category', 'news.category_id', '=', 'category.category_id')->select('slug','headline','newsImage','news.created_at','category') ->orderBy('news_id','desc')->take(5)->get());

        view()->share('top_user', DB::select(DB::raw("SELECT SUM((SELECT COUNT(b.comment_id)  FROM comment b WHERE type='news' AND b.content_id =a.news_id) + (SELECT SUM(c.vote) FROM voted c WHERE c.type='news' AND c.content_id =a.news_id )) AS vote, d.username,d.occupation,d.img FROM news a,user d WHERE a.source = 'user' AND a.post_id = d.user_id AND a.created_at BETWEEN '".date("Y-m-d", strtotime("-710 days"))."' AND '".date("Y-m-d")."' GROUP BY user_id ORDER BY vote DESC LIMIT 5")));

        // SELECT SUM((SELECT COUNT(b.comment_id) FROM comment b WHERE type='news' AND b.content_id =a.news_id) + (SELECT SUM(c.vote) FROM voted c WHERE c.type='news' AND c.content_id =a.news_id )) AS vote, d.user_id,d.username,d.occupation,d.img FROM news a,user d WHERE a.source = 'user' AND a.post_id = d.user_id AND a.created_at BETWEEN '2020-01-06' AND '2020-03-13' GROUP BY user_id ORDER BY vote DESC LIMIT 5
        
        // $vote = Like::where('content_id','=',$content->news_id)
        // ->where('type','=','news')->select('vote', DB::raw("count(*) as total"))
        //     ->groupBy('vote')->get();
    }
}
