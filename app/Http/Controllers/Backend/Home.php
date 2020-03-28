<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Log;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function __construct()
    {
        // $this->middleware('myownauth:staff');
    }

    public function dashboard()
    {
        $data=[
            'active'=> 'dashboard',
            'menu'=>'',
            'user' =>Auth::user()->name
        ];
        return view('Backend/dashboard',$data);
    }
}