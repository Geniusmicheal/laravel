<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class Backup extends Controller{
    public function index()
    {
        // $tables = DB::select('SHOW TABLES');
        // foreach($tables as $table){
        //     if ($table == 'migrations') {
        //         continue;
        //     }
        //     Schema::dropIfExists($table->Tables_in_javiewsc_9jaview);
        // }

        // The YouTube ID
        $key = "Ct5KJKBI9kc";
        // Get all info for video
        $output = file_get_contents('https://www.youtube.com/get_video_info?&video_id='.$key);
        // Parse data to eg.(&id=var)
        $array=[];
        parse_str($output, $array);
        dd($array);
        // Get Quality map of video an set array
        if(isset($url_encoded_fmt_stream_map)) {
        $my_formats_array = explode(',',$url_encoded_fmt_stream_map);
        } 
        // Set Array & Vars
        $avail_formats[] = '';
        $i = 0;
        // Break up array to create download links to quality
        foreach($my_formats_array as $format) {
            parse_str($format);
            echo "<a download='". $title .".mp4' 
            href='".$avail_formats[$i]['url'] = urldecode($url) .
            '&signature=' . $sig."'>". $title .".mp4</a> Quality - ".$quality."<br>"; $i++; 
        }
    }
}
