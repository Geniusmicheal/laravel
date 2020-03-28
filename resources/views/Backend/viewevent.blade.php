<?php
    if(stripos($result->event_date,'*')):
        $eventdate = explode('*', $result->event_date);
        $from = date_format(date_create($eventdate[0]),"jS M") ;
        $to = date_format(date_create($eventdate[1]),"jS M Y");
        $evntdate = $from.' - '.$to;
    else: $evntdate = date_format(date_create($result->event_date),"jS M Y");
    endif;
    $sponsor_by = explode(',', $result->sponsor_by);
    
?>

@extends('Backend/layout')
@section('style') 
    <style>
        .card{
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            /* border-top: 3px solid #00c0ef; */
            word-wrap:normal;
            margin-bottom: 30px;
            height: 500px;
            overflow: auto;

        }
        .card-header {background-color: transparent;}
        .form-control-sm{width: 220px;}
        .card-footer {padding: .75rem 1.25rem 0px 1.25rem; }

        .cover {
            background: url("{{ asset('upload/event/original/'.$result->banner) }}") center no-repeat;
            height: 300px; 
            background-position: top;
            background-repeat: no-repeat;
            background-size: cover;
            background-size: 100% 300px;
            margin: -15px;
            
        }
        .sponser{
            height: 45px;
            width: 45px;
            position: relative;
            border: 2px solid rgb(255, 255, 255);
            display: inline;
            border-radius: 50%;
        }
    </style>

@endsection
@section('content')
    <div class="cover"></div>
    <ol class="breadcrumb has-background-white" style="margin: -15px -15px 15px;">
        <li class="breadcrumb-item"><a href="/dashboard">{{ $record->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Event</li>
    </ol>
    <div class="row">

        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">{{ $result->name }}</div>
                <div class="card-body">
                    <?php if($result->youtube_url =='')  : ?>
                        {!! html_entity_decode($result->about) !!}
                    <?php else : ?>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#home">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#menu1">Video Clip</a>
                            </li>
                        </ul>

                        <div class="tab-content  mb-3">
                            <div id="home" class="container tab-pane active"><br>
                                {!! html_entity_decode($result->about) !!}
                            </div>

                            <div id="menu1" class="container tab-pane fade"><br>
                                <iframe style="width:100%; height: 300px;"  src="{{$result->youtube_url}}?controls=1" ></iframe>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">About News</div>
                <div class="card-body  table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <th>Category</th>
                            <td>{{ $result->category }}</td>
                        </tr>

                        <tr>
                            <th>Country</th>
                            <td>{{ $result->location }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>{{ ucfirst($result->status) }}</td>
                        </tr>

                        <tr>
                            <th>Type</th>
                            <td>{{ $result->event_type  }}</td>
                        </tr>

                        <tr>
                            <th>Tickets </th>
                            <td>Avilable 0 / {{ $result->tickets }}</td>
                        </tr>

                        <tr>
                            <th>Time</th>
                            <td>{{ date_format(date_create($result->event_time), "h:i:sa") }}</td>
                        </tr>

                        <tr>
                            <th>Date</th>
                            <td>{{ $evntdate }} </td>
                        </tr>

                        <tr>
                            <th>Event Address</th>
                            <td>{{ $result->address  }}</td>
                        </tr>
                        <tr>
                            <th>Sponsor by</th>
                            <td>
                                <?php $x=0; foreach($sponsor_by as $sponsor ) :?>
                                    <img src="{{asset('upload/event/compress/'.$sponsor ) }}" class="sponser" style="right: {{$x}}px;">
                                <?php $x+=10; endforeach; ?>
                            </td>
                        </tr>


                        <tr>
                            <th>Contact</th>
                            <td>{{ $result->num_phone  }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $result->email  }}</td>
                        </tr>

                        <tr>
                            <th>Web link</th>
                            <td>{{ $result->website  }}</td>
                        </tr>

                        <tr>
                            <th>Organizer Office</th>
                            <td>{{ $result->office  }}</td>
                        </tr>

                        <tr>
                            <th>Uploaded by</th>
                            <td>{{ ucfirst($result->created_by)  }}</td>
                        </tr>

                        <th>Time Uploaded</th>
                            <td>{{ date_format($result->created_at,"h:i:sa") }}</td>
                        </tr>
                        
                        <tr>
                            <th>Date Uploaded</th>
                            <td>{{ date_format($result->created_at,"l jS \of F Y") }}</td>
                        </tr>
                        


                    </table>
                </div>
            </div>
        </div>
    
    
    
    </div>
@endsection
@section('script')
    //<script>
        var tab = document.querySelectorAll(".nav-tabs a");
        var pane= document.querySelectorAll("div.tab-pane");

        tab[0].addEventListener("click", () => { viewtab(0); });
        tab[1].addEventListener("click", () => {viewtab(1); });

        function viewtab(id){
            if(id==0) var act=1;
            else var act=0;
            tab[act].classList.remove("active");
            pane[act].classList.remove("active");
            pane[act].classList.add("fade");
            pane[id].classList.remove("fade");
            pane[id].classList.add("active");
            tab[id].classList.add("active");
        }    
    //</script>
@endsection


