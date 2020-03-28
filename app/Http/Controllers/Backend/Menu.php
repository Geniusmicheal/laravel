<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Menu extends Controller {
    public function __construct()
    {
        // $this->middleware('myownauth:staff');
    }

    public function index()
    {
        $data=[
            'active'=> 'assign_menu',
            'menu'=>'menu',
            'user' =>Auth::user()->name
        ];
        return view('Backend/menu',$data);
    }
    public function create()
    {
        $data=[
            'active'=> 'assign_menu',
            'menu'=>'menu',
            'user' =>Auth::user()->name
        ];
        return view('Backend/addmenu',$data);
    }

}