<?php 

namespace App\Http\Controllers\Userend;
use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Location;
use App\Models\Event;
use Illuminate\Http\Request;
// use App\Models\Userend\User as Users; 
use App\Models\Content;

use Image;
// use Illuminate\Support\Facades\Hash;
// use Auth;

class Insert extends Controller{
    public function index($type, $id=null){
        if($type=='event'){
            if($id != null){
                $content= Event::where('slug','=',$id)
                ->leftJoin('category', 'event.category_id', '=', 'category.category_id')
                    ->leftJoin('location', 'event.location_id', '=', 'location.location_id')
                        ->orderBy('event_id','desc')->first();
                $data=[
                    'type' => $type,
                    'search' => 'event',
                    'category' => Category::all(),
                    'location' => Location::all(),
                    'result' => $content
                ];
            }else{
                $data=[
                    'type' => $type,
                    'search' => 'news',
                    'category' => Category::all(),
                    'location' => Location::all()
                ];
 
            }
            return view('Userend/addevent', $data);
        }else{
            if($id != null){}else{
                $data=[
                    'type' => $type,
                    'search' => 'news',
                    // 'category' => Category::all(),
                    'location' => Location::all()
                ];
 
            }
            return view('Userend/addnews', $data);
           
        }

    }

    public function event(Request $request,$id = null){
        $request->validate([  
            'name'   => 'required|min:6',
            'event_time' => 'required|max:5',
            'category' => 'required|numeric',
            'event_date_from' =>'required',
            'event_date_to' =>'nullable|min:6',
            'youtube_url' => 'nullable|min:6',
            'banner' =>($id != null) ? 'nullable' :'required'. '|image|mimes:jpeg,png,jpg|max:2048',
            'event_type' =>'required|max:4',
            // 'tickets' => 'nullable|numeric',
            'country' =>'required|numeric',
            'address' =>'required|min:6',
            'content' =>'required|min:6',

            'num_phone' => 'required|min:6',
            'email' => "required|min:4",
            // 'email.*' => "required|email|distinct|min:4",
            'office' => 'required|min:6',
            'website' => 'nullable|min:6',
            'sponsor_by.*' => ($id != null) ? 'nullable' :'required'.'|mimes:jpg,jpeg,png|max:2048'
        ]);

        $raw_slug = preg_replace("/[^a-zA-Z0-9\s]/", "", $request->name);
        $slug = str_replace(' ','-',$raw_slug);

        for ($i=1; $i < 100 ; $i++) { 
            $eventmodel= Event::where('slug', $slug)->first();
            if (!$eventmodel) break; else $slug.=$i; 
        }

        if($request->hasfile('sponsor_by')){

            $path = public_path()."/upload/event/";
            $sponsor_by=$request->file('sponsor_by');
            $sponsor='';
            if($id !=null){
                $exSponsor = explode(',',$request->exSponsor);
                foreach( $exSponsor as $ex_Sponsor){
                    if(file_exists($path.'compress/' .$ex_Sponsor) ){
                        unlink($path.'compress/' .$ex_Sponsor);
                        unlink($path.'original/' .$ex_Sponsor);
                    }
                    
                }
            }
            
            foreach($sponsor_by as $photo){

                $file = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $file_name=$file.'_'.time().'.'.$photo->getClientOriginalExtension();
                $image_resize = Image::make($photo->getRealPath()); 
                $image_resize->resize(400,400);

                $image_resize->save($path."compress/".$file_name);
                $photo->move($path."original/" , $file_name);
                $sponsor=='' ? $sponsor = $file_name : $sponsor .=','.$file_name ;
            } 
        }

        if($request->hasfile('banner')){

            if($id !=null && file_exists($path."compress/".$request->exBanner) ){
                unlink($path."compress/".$request->exBanner); 
                unlink($path."original/".$request->exBanner); 
            }
           
            $image=$request->file('banner');
            $banner_name=time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());  
            $image_resize->resize(1573,400);
            $image_resize->save($path."compress/".$banner_name);
            $image->move($path."original/" , $banner_name);
        }
        $dateEvent = $request->event_date_to =='' ? '':'*'.$request->event_date_to ;

        if($id == null){
            $EventModel = Event::create([
                'name' =>  $request->name,
                'event_time' => $request->event_time,
                'category_id' => $request->category,
                'event_date' => $request->event_date_from . $dateEvent,
                'youtube_url' =>  $request->youtube_url,
                'banner' => $banner_name,
                'event_type' =>$request->event_type,
                'tickets' => $request->tickets,
                'location_id' => $request->country,
                'address' => $request->address,
                'about' => htmlentities($request->content),
                'num_phone' => $request->num_phone,
                'email' => $request->email,
                'office' => $request->office,
                'website' => $request->website,
                'Sponsor_by' => $sponsor,
    
                'slug' => $slug,
                'created_by' => 'user',
                'created_id' => auth()->guard('user')->user()->user_id,
                'status' => 'disactive'
                
            ]);
            return back()->with('success', 'Event successfully added.');
        }else{
            Event::where('event_id',$id)->update([
                'name' =>  $request->name,
                'event_time' => $request->event_time,
                'category_id' => $request->category,
                'event_date' => $request->event_date_from . $dateEvent,
                'youtube_url' =>  $request->youtube_url,
                'banner' => (!isset($banner_name)) ? $request->exBanner : $banner_name,
                'event_type' =>$request->event_type,
                'tickets' => $request->tickets,
                'location_id' => $request->country,
                'address' => $request->address,
                'about' => htmlentities($request->content),
                'num_phone' => $request->num_phone,
                'email' => $request->email,
                'office' => $request->office,
                'website' => $request->website,
                'Sponsor_by' => (!isset($sponsor)) ? $request->exSponsor : $sponsor,
                'slug' => $slug
            ]);
            return redirect()->route('userevent',['id' => auth()->guard('user')->user()->username ])->with('success','Event successfully Upload!');
        }
    }

    public function upload(Request $request,$id = null)
    {
        $request->validate([  
            'headline'   => 'required|min:6',
            'editordata' => 'required|min:6',
            'customFile' => ($id != null) ? 'nullable' :'required'. '|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $category= Category::where('category', ucfirst($request->type))->first();

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

        if($id == null){
            $content = Content::create([
                'post_id' => auth()->guard('user')->user()->user_id,
                'home' =>0,
                'headline' =>  $request->headline,
                'slug' => $slug,
                'category_id' => $category->category_id,
                'location_id' => $request->country,
                'source' => 'user',
                'short_content' => substr(strip_tags($request->editordata),200),
                'content' => htmlentities($request->editordata),
                'newsImage' => $file_name
            ]);
            return back()->with('success', ucfirst($request->type).' successfully added.');
        }else{
            $content = Content::where('news_id',$id)->update([
                'headline' =>  $request->headline,
                'slug' => $slug,
                'short_content' => substr(strip_tags($request->editordata),200),
                'content' => htmlentities($request->editordata),

                'location_id' => $request->country,
                'newsImage' => (!isset($file_name)) ? $request->exImg : $file_name 
            ]);
        }
    }
}

