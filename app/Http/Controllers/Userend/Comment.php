<?php 

namespace App\Http\Controllers\Userend;
use App\Http\Controllers\Controller;
use App\Models\Userend\Comment as ModelComment;
use Illuminate\Http\Request;
use App\Models\Userend\Like;


class Comment extends Controller{

    public function index(Request $request){
        // dd($request);
        $this->validate($request ,[
            'comment'   => 'required',
            'detail' => 'required',
        ]);
        $detail = explode('~',$request->detail);

        ModelComment::create([
            'user_id' => $detail[1],
            'parent_id' => (count($detail)== 4) ? $detail[3]: '',
            'content_id' => $detail[0],
            'type' => $detail[2],
            'comment' => $request->comment,
            'like' => 0
        ]);
    }

    public function vote(Request $request){
        $detail = explode('~',$request->detail);

        Like::create([
            'user_id' => $detail[1],
            'content_id' => $detail[0],
            'type' => $detail[2],
            'vote' => $request->like
        ]);
    }
}