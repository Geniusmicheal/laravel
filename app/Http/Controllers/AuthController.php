<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Backend\Log;




class AuthController extends Controller{
    public function index(){ return view('Backend/login');}

    public function login(Request $request)
    {
        $this->validate($request ,[
            'email'   => 'required|email',
            'password' => 'required|min:6',
        ]);
        
        $user_data=[
            'email' => $request->email,
            'password' => $request->password,
            // $request->get('remember_token')
        ];
        if($user = auth()->guard('staff')->attempt($user_data,false)) 
        {
            $ip=$_SERVER['REMOTE_ADDR'];
            if($ip =='127.0.0.1')$ip='105.112.75.203';
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
            session(['Location' => $request->locat." . " .$details->region.', '.$details->country ]);

            $log= new Log;
            $log->staff_id = auth()->guard('staff')->user()->staff_id;
            $log->stafflog ="Logged in on ".session('Location');
            $log->item_id = auth()->guard('staff')->user()->staff_id;
            $log->item_type = 'login';
            $log->save();
            return redirect()->route('staffdashboard');
        }

       
        else return back()->with('error', 'Wrong Login Details');
      
            
    }

    public function logout(Request $request)
    {
        if (Auth::guard('staff')->check()) $location='stafflogin';
        else $location='home';

        auth()->guard()->logout();
        $request->session()->flush();
        return  redirect()->route($location);
        
    }
}
