<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Backend\Log;
use App\Models\Backend\Category;
use App\Models\Backend\Location;
use App\Models\Event as EventModel;
use Image;
use Illuminate\Http\Request;
use Auth;

class Event extends Controller{

    public function index(){

        $event= EventModel::select('event.event_id','event.slug','event.name','event.event_date')
        ->orderBy('event.event_id','desc')->where('status', $_GET['type'])->paginate(10);
       
        $data=[
            'active'=> $_GET['type'],
            'menu'=>'event',
            'record' => Auth::user(),
            'event' =>  $event
        ];
        return view('Backend/event',$data);
    }

    public function switch($id){
        $record = explode('~',$id);
        
        EventModel::where('event_id',$record[1] )->update([
            'status' => $_GET['type']
        ]);
        
        $log= new Log;
        $log->staff_id = Auth::user()->staff_id;
        $log->item_type = 'event';
        $log->stafflog ="Event was ". $_GET['type'] == 'active' ? 'activate': 'dectivate'." on ".session('Location');
        $log->item_id =  $record[1];
        $mess = 'Event '.$record[2].' was '.($_GET['type'] == 'active' ? 'activate ': 'dectivate ').'successfuly.'; 
        $log->save();
        return back()->with('delete', $mess);
    }

    public function show($id = null){

        if ($id == null) {
            $data=[
                'active'=> 'addEvent',
                'menu'=>'event',
                'record' => Auth::user(),
                'category' => Category::all(),
                'location' => Location::all()
            ];
        }else{
            $check_id= explode('~',$id);
            if($check_id[1]=='view')
                $event= EventModel::where('slug','=',$check_id[0])
                    ->leftJoin('category', 'event.category_id', '=', 'category.category_id')
                        ->leftJoin('location', 'event.location_id', '=', 'location.location_id')        ->first();

            else $event= EventModel::where('slug','=',$check_id[0])->firstOrFail();

            $data=[
                'active'=> 'active',
                'menu'=>'event',
                'record' => Auth::user(),
                'category' => Category::all(),
                'location' => Location::all(),
                'result' => $event
            ];
        }
        if(isset($check_id) && $check_id[1]=='view')
        return view('Backend/viewevent',$data);
        else return view('Backend/addevent',$data);
    }

    public function upload(Request $request,$id = null)
    {
        
        $request->validate([  
            'name'   => 'required|min:6',
            'event_time' => 'required|max:5',
            'category' => 'required|numeric',
            'event_date_from' =>'required',
            'event_date_to' =>'nullable|min:6',
            'youtube_url' => 'nullable|min:6',
            'banner' =>($id != null) ? 'nullable' :'required'. '|image|mimes:jpeg,png,jpg|max:2048',
            'event_type' =>'required|max:4',
            'tickets' => 'nullable|numeric',
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
            $eventmodel= EventModel::where('slug', $slug)->first();
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
        $log= new Log;
        $log->staff_id = Auth::user()->staff_id;
        $log->item_type = 'event';
        $log->save();

        if($id == null){
            $EventModel = EventModel::create([
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
                'created_by' => 'staff',
                'created_id' => Auth::user()->staff_id,
                'status' => 'active'
            ]);

            $log->stafflog ="Event was Inserted on ".session('Location');
            $log->item_id =  $EventModel->event_id;
        }else{
            $EventModel = EventModel::where('event_id',$id)->update([
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
            $log->stafflog ="Event was updated on ".session('Location');
            $log->item_id =$id;
        }
        $log->save();
        if($id == null)
        return redirect()->route('staffaddevent')->with('success','Event successfully Upload!');
        else return redirect('control/dashboard/event?type=active')->with('delete',$request->name.' event successfully updated!');
    }
}