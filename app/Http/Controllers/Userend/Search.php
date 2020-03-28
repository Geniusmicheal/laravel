<?php
namespace App\Http\Controllers\Userend;
use App\Http\Controllers\Controller;
// use App\Models\Userend\User as Users; 
use App\Models\Content;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use App\Models\Backend\Category;
use App\Models\Event as EventModel;

class Search extends Controller{
    public function index($id, Request $request){
        if($id =='news')  
        $content= Content::where('news.content','Like',"%$request->search%")   
            ->select('news.slug','news.headline','news.newsImage','category.category','location.location','news.short_content')
                ->orWhere('news.headline','Like',"%$request->search%")
                    ->leftJoin('category', 'news.category_id', '=', 'category.category_id')
                        ->leftJoin('location', 'news.location_id', '=', 'location.location_id')
                            ->orderBy('news_id','desc')->paginate(20);

        elseif( $id == 'event')
        $content= EventModel::where('about','Like',"%$request->search%")
            ->orWhere('name','Like',"%$request->search%")
                ->select('event.about','event.slug','event.name','event.event_date', 'category.category')
                    ->leftJoin('category', 'event.category_id', '=', 'category.category_id')
                        ->orderBy('event.event_id','desc')->where('status','active')->paginate(15);

        $data=[
            'active'=> '',
            'content' => $content,
            'search' => $id
            
        ];
        if($id=='event') return view('Userend/event', $data);
        else return view('Userend/tags', $data);
    }
}