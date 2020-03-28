<?php 

namespace App\Http\Controllers\Userend;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Event as EventModel;
use Illuminate\Support\Facades\DB;
use App\Models\Userend\Comment;
use App\Models\Userend\User;
use App\Models\Userend\Like;

class Home extends Controller{

    public function index(){
        // dd(Auth::user());
        // $content= Content::where('home',1)->select('news.slug','news.headline','news.newsImage','category.category','location.location','news.short_content')
        //     ->leftJoin('category', 'news.category_id', '=', 'category.category_id')
        //     ->leftJoin('location', 'news.location_id', '=', 'location.location_id')
        //     ->orderBy('news_id','desc')->paginate(20);

        $content= Content::where('home',1)->orderBy('news_id','desc')->paginate(20);
        $data=[
            'banner' =>'',
            'active'=> '',
            'content' => $content,
            'search' => 'news'
            
        ];
        return view('Userend/home', $data);
    }

    public function read($type,$slug){
    //    $sticker = json_decode(file_get_contents('https://swapi.co/api/people/'), true);
    //     dd($sticker);
        $usercheck =1;
        if($type=='event'){
            $id='event';
            $content= EventModel::where('slug','=',$slug)
            ->leftJoin('category', 'event.category_id', '=', 'category.category_id')
                ->leftJoin('location', 'event.location_id', '=', 'location.location_id')
                    ->orderBy('event_id','desc')->first();

                    // dd($content);
                    if ($content->created_by =='user'){

                    } $comment= $unlike = $like =$commentCount= '';
        }else{
            // $content= Content::where('slug','=',$slug)
            // ->leftJoin('category', 'news.category_id', '=', 'category.category_id')
            //     ->leftJoin('location', 'news.location_id', '=', 'location.location_id')
            //         ->orderBy('news_id','desc')->first();

            $content= Content::where('slug','=',$slug)->first();
           $comment= Comment::where('content_id','=',$content->news_id)
                // ->where('type','=','news')->where('parent_id','=',NULL)
                //     ->leftJoin('user', 'comment.user_id', '=', 'user.user_id')
                        ->orderBy('comment_id','asc')->paginate(10);
                        
            $commentCount =Comment::where('content_id','=',$content->news_id)
            ->where('type','=','news')->count();

            $vote = Like::where('content_id','=',$content->news_id)
                ->where('type','=','news')->select('vote', DB::raw("count(*) as total"))
                    ->groupBy('vote')->get();

                    // $results = DB::select( DB::raw("SELECT news_id FROM  WHERE source = 'user'") );
                    // $text = Content::where('source','user')->select('news_id')->get();
                    //SELECT news_id,post_id FROM news WHERE source = 'user' AND created_at BETWEEN '2020-01-04' AND '2020-03-11'
                    // SELECT a.content_id AS com_news, b.content_id As vote_news, COUNT(a.comment_id) AS tcom, COUNT(b.content_id) FROM comment a, voted b WHERE a.type='news' AND b.type = 'news' AND a.created_at BETWEEN '2020-01-04' AND '2020-03-11' AND b.created_at BETWEEN '2020-01-04' AND '2020-03-11' AND GROUP BY a.content_id; 
                    //SELECT  a.content_id AS com_news, b.content_id As vote_news , COUNT( DISTINCT a.comment_id) AS tcom, COUNT(  b.content_id)  FROM comment a, voted b WHERE a.type='news' AND b.type = 'news' AND a.created_at BETWEEN '2020-01-04' AND '2020-03-11' AND b.created_at BETWEEN '2020-01-04' AND '2020-03-11' 



            //         $text = ;
            // dd($text);
            if(count($vote)==2){
                ($vote[1]->vote > 0)? $like = $vote[1]->total : $unlike = $vote[1]->total ;
                ($vote[0]->vote > 0)? $like = $vote[0]->total : $unlike = $vote[0]->total ;
            }else{
                $like=$unlike=0;
                ($vote[0]->vote > 0)? $like = $vote[0]->total : $unlike = $vote[0]->total ;
            }
            $id='news';
            if(auth()->guard('user')->check()){
                $user = Like::where('content_id','=',$content->news_id)->where('type','=','news')
                ->where('user_id','=',(auth()->guard('user')->user()->user_id) )->first();
            
                if ($user != null) $usercheck =1;
                else $usercheck =0;
            }

            if($content->source =='user'){
                $userPost= User::where('user_id','=',$content->post_id)
                    ->select('username','img')->first();
                $source=[
                    'username'=> $userPost->username,
                    'img' => ($userPost->img == '')? asset('img/profile.png') : asset('upload/user/compress/'.$userPost->img ),
                    'url' => $userPost->username
                ];
            }
        }

        if(!isset($source)){
            $source=[
                'username'=> 'Admin',
                'img' => 'img/logo.png',
                'url' => ''
            ];
        }
    // dd($comment);
        $data=[
            'active'=> '',
           'content' => $content,
            'source' => $source,
            'comment' => $comment,
            'unlike' =>$unlike,
            'like' =>$like,
            'usercheck' =>$usercheck,
            'commentCount' =>$commentCount,
            'search' => $id
            // 'sticker' => $sticker['data']
        ];
        if($type=='event')  return view('Userend/viewevent', $data);
        else return view('Userend/readnews', $data);
    }
}

