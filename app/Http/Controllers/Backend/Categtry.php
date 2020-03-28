<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Backend\Log;
use App\Models\Backend\Category;
use App\Models\Backend\Location;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Models\Event as EventModel;
use App\Models\Userend\Comment;
use Auth;

class Categtry extends Controller{
    public function index()
    {
        $data=[
            'active'=> 'category',
            'menu'=>'blog',
            'record' => Auth::user(),
            'category' => Category::paginate(10)
        ];
        return view('Backend/category',$data);
    }

    public function category(Request $request){
        $request->validate([ 'category'   => 'required|min:3']);
        
        $category = Category::firstOrCreate(['category' => $request->category],[
            'category' => $request->category, 
            'staff_id' => Auth::user()->staff_id
        ]);

        $log= new Log;
        $log->staff_id = Auth::user()->staff_id;
        $log->stafflog ="Category was created on ".session('Location');
        $log->item_id = $category->category_id;
        $log->item_type = 'category';
        $log->save();
        return back()->with('success', 'Category has been added successfully');
        
    }

    public function location()
    {
       
        $data=[
            'active'=> 'location',
            'menu'=>'blog',
            'record' => Auth::user(),
            'location' => Location::paginate(10)
        ];
        return view('Backend/location',$data);
    }

    public function country(Request $request)
    {
        $request->validate([ 'location'   => 'required|min:3']);
        
        $country = Location::firstOrCreate(['location' => $request->location],[
            'location' => $request->location, 
            'staff_id' => Auth::user()->staff_id
        ]);

        $log= new Log;
        $log->staff_id = Auth::user()->staff_id;
        $log->stafflog ="Location was created on ".session('Location');
        $log->item_id = $country->location_id;
        $log->item_type = 'location';
        $log->save();
        return back()->with('success', 'Location has been added successfully');
    }

    public function delete($id)
    {
        $recordArray= explode('~',$id);
        $log= new Log;

        if($recordArray[1]=='category'){
            Category::find($recordArray[0])->delete();
            $log->stafflog ='Category "'. $recordArray[2].'" was deleted on '.session('Location');
        }else if($recordArray[1]=='location'){
            Location::find($recordArray[0])->delete();
            $log->stafflog ='Location "'. $recordArray[2].'" was deleted on '.session('Location');

        }elseif($recordArray[1]=='news'){
            Content::find($recordArray[0])->delete();
            $log->stafflog ='News "'. $recordArray[2].'" was deleted on '.session('Location');
        }elseif($recordArray[1]=='event'){
            EventModel::find($recordArray[0])->delete();
            $log->stafflog ='Event "'. $recordArray[2].'" was deleted on '.session('Location');
        }elseif($recordArray[1]=='comment'){
            Comment::find($recordArray[0])->delete();
            $log->stafflog ='Event "'. $recordArray[2].'" was deleted on '.session('Location');
        }
        $log->staff_id = Auth::user()->staff_id;
        $log->item_id = $recordArray[0];
        $log->item_type = $recordArray[1];
        $log->save();
        return back()->with('delete', ucfirst($recordArray[1]).' '. $recordArray[2].' has been deleted successfully');
    }
}
