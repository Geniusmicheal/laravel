<?php

namespace App\Http\Controllers\Userend;
use App\Http\Controllers\Controller;
// use App\Jobs\SendMail;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Models\Userend\AuthUser;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{
    public function login(Request $request)
    {
        $this->validate($request ,[
            'username'   => 'required|min:2',
            'password' => 'required|min:6',
        ]);
        
        $user_data=[
            'username' => $request->username,
            'password' => $request->password
        ];

        if(auth()->guard('user')->attempt($user_data,false)) return redirect()->route('home');
        else return back()->with('error', 'Wrong Login Details');
    }

    public function signup(Request $request)
    {
        $this->validate($request ,[
            'username'   => 'required|min:2',
            'email' => 'required|email',
            'password'   => 'required|min:6',
            'password_confirmation' => 'min:6|required_with:password|same:password'
        ]);
       
        $user = AuthUser::where('email', '=',  $request->email)
            ->orWhere('username', '=', $request->username)->first();
        if ($user != null) 
        return back()->with('error', 'Email or Username has been used');
     
        $users = AuthUser::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::guard('user')->login($users);
        $content ="Thank you for signing up for 9javiews! We're excited to help you get up and running. To start, here is some important information about your account.";

        // dispatch(new SendMail([
        //     'to' => auth()->guard('user')->user()->email,
        // ]));
        // return  dd(auth()->guard('user')->user()->email);
        $header = "";
        $footer ="";
        
        $data=[
            'title'=>'Hello '.ucfirst($request->username),
            'header' => $header, 
            'content' => $content,
            'footer' => $footer
        ];

        Mail::to($request->email)->send(new SendMailable($data));
        return redirect()->route('home');
    }
}
// -> subject('jksdsdjksdksd') Auth::user()
