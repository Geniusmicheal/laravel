<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Backend\Staff;
use App\Models\Backend\Log;
use Image;
use Illuminate\Http\Request;
use Auth;

class Account extends Controller{
    public function __construct(){
        
    }
    public function index()
    {
        $log= Log::where('staff_id',Auth::user()->staff_id)
            ->orderBy('log_id','desc')->offset(0)->limit(10)->get()->toArray();
        $data=[
            'active'=> 'profile',
            'menu'=>'account',
            'record' => Auth::user(),
            'log' =>$log
        ];
        return view('Backend/profile',$data);
    }

    public function edit()
    {
        $data=[
            'active'=> 'editprofile',
            'menu'=>'account',
            'record' =>  Auth::user()
        ];
        return view('Backend/editprofile',$data);
    }

    public function update(Request $request)
    {
        $request->validate([  
            'fullname'   => 'required|min:6',
            'address' => 'required|min:6',
            'pnumber' => 'required|min:11',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $profile = Staff::find(Auth::user()->staff_id);
        if($request->hasfile('profile')){
            $avatar = Auth::user()->avatar;
            $path = public_path()."/upload/avatar/";
            if($avatar !=null && file_exists($path."compress/".$avatar) )
            {
                unlink($path."compress/".$avatar);
                unlink($path."original/".$avatar);
            }
            $image=$request->file('profile');
            $file_name=time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());  
            $image_resize->resize(400,400);
            $image_resize->save($path."compress/".$file_name);
            $image->move($path."original/" , $file_name);
            $profile->avatar=$file_name;
        }
        
        $profile->name=$request->fullname;
        $profile->pnumber=$request->pnumber;
        $profile->address=$request->address;
        $profile->save();

        $log= new Log;
        $log->staff_id = Auth::user()->staff_id;
        $log->stafflog ="Update profile on ".session('Location');
        $log->item_id = Auth::user()->staff_id;
        $log->item_type = 'profile';
        $log->save();

        return redirect()->route('staffprofile')->with('success','Profile Successfully Update!');

        
    }

    public function editpassword()
    {
        $data=[
            'active'=> 'editpassword',
            'menu'=>'account',
            'record' =>  Auth::user()
        ];
        return view('Backend/editpassword',$data);
    }

    public function changepassword(Request $request)
    {
        $request->validate([  
            'oldpassword'   => 'required|min:6',
            'newpassword' => 'required|min:6|different:oldpassword',
            're_password' => 'required|min:6|same:newpassword'
        ]);
        if(password_verify($request->oldpassword, Auth::user()->password) == false)
        return back()->with('error', 'Invalid current password');

        $profile = Staff::find(Auth::user()->staff_id);
        $profile->password=password_hash($request->newpassword, PASSWORD_BCRYPT,['cost' => 10]);
        $profile->save();


        $log= new Log;
        $log->staff_id = Auth::user()->staff_id;
        $log->stafflog ="Change password on ".session('Location');
        $log->item_id = Auth::user()->staff_id;
        $log->item_type = 'changePassword';
        $log->save();

        return redirect()->route('staffprofile')->with('success','Password Successfully Change!');
        
    }

    public function stafflog()
    {
       
        $log= Log::where('staff_id',Auth::user()->staff_id)
        ->orderBy('log_id','desc')->paginate(10);
        
        $data=[
            'active'=> 'stafflog',
            'menu'=>'account',
            'record' =>  Auth::user(),
            'log'=>$log
        ];
        return view('Backend/log',$data);
    }
}