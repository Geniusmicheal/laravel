<?php 

namespace App\Http\Controllers\Userend;
use App\Http\Controllers\Controller;
use App\Models\Userend\User as Users; 
use App\Models\Content;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Hash;
// use App\Models\Backend\Category;
use App\Models\Event as EventModel;
// use Auth;

class User extends Controller{
    public function index($id){
        $user= Users::where('username',$id)->first();
        $content= Content::where('source','user')
            ->select('news.slug','news.headline','news.newsImage','category.category')
                ->leftJoin('category', 'news.category_id', '=', 'category.category_id')
                    ->where('post_id',$user->user_id)
                        ->orderBy('news_id','desc')->paginate(20);
        $data =[
            'search' => 'news',
            'user' => $user, 
            'content' => $content
        ];
        return view('Userend/profile', $data);
    }

    public function event($id){
        $user= Users::where('username',$id)->first();
        // $content= Content::where('source','user')->where('post_id',$user->user_id)->select('news.slug','news.headline','news.newsImage','category.category')
        // ->leftJoin('category', 'news.category_id', '=', 'category.category_id')
        // ->orderBy('news_id','desc')->paginate(20);

        $content= EventModel::where('created_by','user')->where('created_id',$user->user_id)->select('event.about','event.slug','event.name','event.event_date', 'category.category')
        ->leftJoin('category', 'event.category_id', '=', 'category.category_id')
            ->orderBy('event.event_id','desc')->paginate(15);
       
        $data =[
            'search' => 'event',
            'user' => $user, 
            'content' => $content
        ];
        return view('Userend/profile', $data);

    }

    public function edit($id){
        $user= Users::where('username',$id)->first();
        $data =[
            'user' => $user,
            'search' => 'news'
        ];
        return view('Userend/editprofile', $data);
    }

    public function update(Request $request){

        $this->validate($request ,[
            'username'   => 'required|min:2',
            'email'   => 'required|email',
            'phone_number' => 'nullable|min:11',
            'facebook' => 'nullable|min:11',
            'twitter' => 'nullable|min:11',
            'occupation' => 'nullable|min:2',
            'profile' => 'nullable |image|mimes:jpeg,png,jpg|max:2048'

        ]);

        $user = AuthUser::where('email', '=',  $request->email)
        ->orWhere('username', '=', $request->username)->first();
        if ($user != null) 
        return back()->with('error', 'Email or Username has been used');


        $profile = Users::find(auth()->guard('user')->user()->user_id);

        if($request->hasfile('profile')){
            $avatar = auth()->guard('user')->user()->img;
            $path = public_path()."upload/user/";
            if($avatar !=null && file_exists($path."compress/".$avatar) )
            {
                unlink($path."compress/".$avatar);
                unlink($path."original/".$avatar);
            }
            $image=$request->file('profile');
            $file_name=rand(10000,9999).time().'.'.$image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());  
            $image_resize->resize(400,400);
            $image_resize->save($path."compress/".$file_name);
            $image->move($path."original/" , $file_name);
            $profile->avatar=$file_name;
        }
        
        $profile->username=$request->username;
        $profile->email=$request->email;
        $profile->phone_number=$request->phone_number;

        $profile->social_media=$request->twitter.'~'.$request->facebook;
        $profile->occupation=$request->occupation;
        $profile->dob=$request->dob;

        $profile->current_location=$request->current_location;
        $profile->about=$request->about;
        $profile->save();

        return redirect()->route('userprofile', ['id'=> $request->username])->with('success','Profile Successfully Update!');

    }
    public function password($id){
        $data =[
            'search' => 'news'
        ];
        return view('Userend/changepassword', $data);
    }

    public function updatepassword(Request $request){
        $this->validate($request ,[
            'current'   => 'required|',
            'new'   => 'required|min:6|different:current',
            'reType'   => 'required|min:6|same:new'
        ]);
        if(Hash::check($request->current,auth()->guard('user')->user()->password)){

            $profile = Users::find(auth()->guard('user')->user()->user_id);
            $profile->password=Hash::make($request->new);

            $profile->save();
            return redirect()->route('userprofile', ['id'=> $request->username])->with('success','Profile Successfully Update!');

        }else return back()->with('error', 'Invaild Password');
    }
}