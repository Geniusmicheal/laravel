<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Backend\Log;
use App\Models\Content;
use App\Models\Backend\Category;
use App\Models\Backend\Location;
use Illuminate\Http\Request;
use Auth;
use App\Models\Userend\Comment;

class NewsContent extends Controller{
    public function index()
    {
        $content= Content::leftJoin('category', 'news.category_id', '=', 'category.category_id')
            ->select('news.news_id','news.slug','category.category','news.headline', 'news.source','news.created_at')
                ->orderBy('news_id','desc')->paginate(10);
        

        $data=[
            'active'=> 'news',
            'menu'=>'blog',
            'record' => Auth::user(),
            'content' =>  $content
            
        ];
        return view('Backend/overview',$data);
    }


    public function show($id = null)
    {
        if ($id == null) {
            $data=[
                'active'=> 'news',
                'menu'=>'blog',
                'record' => Auth::user(),
                'category' => Category::all(),
                'location' => Location::all()
                
            ];
        }else{
            $comment='';
            $check_id= explode('~',$id);
            if($check_id[1]=='view'){
           
            $content= Content::where('slug','=',$check_id[0])
                ->leftJoin('category', 'news.category_id', '=', 'category.category_id')
                    ->leftJoin('location', 'news.location_id', '=', 'location.location_id')
                        ->orderBy('news_id','desc')->first();

            $comment= Comment::where('content_id','=',$content->news_id)
                ->orderBy('comment_id','desc')->paginate(10);
            }else $content=  Content::where('slug','=',$check_id[0])->firstOrFail();
            $data=[
                'active'=> 'news',
                'menu'=>'blog',
                'record' => Auth::user(),
                'category' => Category::all(),
                'location' => Location::all(),
                'result' => $content,
                'comment' => $comment
            ];
        }
        if(isset($check_id) && $check_id[1]=='view')
        return view('Backend/viewnews',$data);
        else return view('Backend/insertnews',$data);
    }

    public function upload(Request $request,$id = null)
    {
     
        $request->validate([  
            'headline'   => 'required|min:6',
            'category' => 'required',
            'country' => 'required',
            'shortNews'   => 'required|min:6',
            'editordata' => 'required|min:6',
            'customFile' => ($id != null) ? 'nullable' :'required'. '|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        
        $raw_slug = preg_replace("/[^a-zA-Z0-9\s]/", "", $request->headline);
        $slug = str_replace(' ','-',$raw_slug);

        for ($i=1; $i < 100 ; $i++) { 
            $content= Content::where('slug', $slug)->first();
            if (!$content) break; else $slug.=$i; 
        }
        if($request->hasfile('customFile')){
            if($id !=null && file_exists(public_path()."/upload/".$request->exImg) )
            unlink(public_path()."/upload/".$request->exImg);

            $image=$request->file('customFile');
            $file_name=time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path()."/upload/" , $file_name);
        }

        $log= new Log;
        $log->staff_id = Auth::user()->staff_id;
        $log->item_type = 'news';

        if($id == null){

            $content = Content::create([
                'headline' =>  $request->headline,
                'slug' => $slug,
                'category_id' => $request->category,
                'location_id' => $request->country,
                'source_url' => $request->source_url,
                'source' => 'Admin',
                'short_content' => str_replace('\r\n','',$request->shortNews),
                'content' => htmlentities($request->editordata),
                'newsImage' => $file_name,
                'download_url' => $request->download_url,
                'home' =>$request->home,
                'post_id' => Auth::user()->staff_id

            ]);
            $log->stafflog ="News was Inserted on ".session('Location');
            $log->item_id =  $content->news_id;
        }else{
            $content = Content::where('news_id',$id)->update([
                'headline' =>  $request->headline,
                'slug' => $slug,
                'category_id' => $request->category,
                'location_id' => $request->country,
                'source_url' => $request->source_url,
                'source' => 'Admin',
                'short_content' => str_replace('\r\n','',$request->shortNews),
                'content' => htmlentities($request->editordata),
                'download_url' => $request->download_url,
                'home' =>$request->home,
                'newsImage' => (!isset($file_name)) ? $request->exImg : $file_name 
            ]);
            $log->stafflog ="News was updated on ".session('Location');
            $log->item_id =$id;
        }
        $log->item_type = 'news';
        $log->save();
        if($id == null)
        return redirect()->route('staffAddNews')->with('success','News successfully Upload!');
        else return redirect()->route('staffoverview')->with('delete',$request->headline.' news successfully updated!');
    }
}
