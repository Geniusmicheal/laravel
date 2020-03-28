<?php 

namespace App\Http\Controllers\Userend;
use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Event as EventModel;
use Illuminate\Http\Request;
use App\Models\Backend\Contact;
use Auth;

class Tags extends Controller{

    public function index($tag){
        $id='news';
        if($tag=='forum'){
            $content ='';
            if(auth()->guard('user')->check())return redirect()->route('home');
        } 

        elseif($tag=='event') {
            $content= EventModel::select('event.about','event.slug','event.name','event.event_date', 'category.category')
                ->leftJoin('category', 'event.category_id', '=', 'category.category_id')
                    ->orderBy('event.event_id','desc')->where('status','active')->paginate(15);
            $id='event';
        }
        else{
            $content = Category::where('category',$tag)
            ->select('news.slug','news.headline','news.newsImage','category.category','location.location','news.short_content')
                ->leftJoin('news', 'category.category_id' , '=', 'news.category_id' )
                    ->leftJoin('location', 'news.location_id', '=', 'location.location_id')
                    ->orderBy('news_id','desc')->paginate(20);

            if($content[0]->slug ==null) return redirect()->route('home');
        } 
        
        $data=[
            'active'=> 'forum',
            'content' => $content,
            'search' => $id,
            'tag'=>$tag
        ];
        // dd($data);
        if($tag=='forum') return view('Userend/forum', $data);
        elseif($tag=='event') return view('Userend/event', $data);
        else return view('Userend/tags', $data);
    }

    public function policy(){
        $data=[
            'search' => 'news',
            'active'=> 'fr',
        ];
        return view('Userend/policy', $data);
    }
    public function contact(){
        $data=[
            'search' => 'news',
            'active'=> 'fr',
        ];
        return view('Userend/contact', $data);
    }
    public function contactIpt(Request $request)
    {
        $request->validate([  
            'name'   => 'required|min:6',
            'mail' => 'required|min:6',
            'comment' => 'required|min:6'
        ]);
        Contact::create([
            'name'  =>  $request->name,
            'email'  =>  $request->mail,
            'message'  =>  $request->comment
        ]);
        return back()->with('success', 'Message Successfully Send');
    }
}