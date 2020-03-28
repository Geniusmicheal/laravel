@extends('Backend/layout')
@section('style')

    <style>
        .card{
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-top: 3px solid #00c0ef;
            word-wrap:normal;

        }
        .form-control-sm{width: 220px;}

        .username-dt {
            background-color: #004ffc;
            padding-top: 40px;
        }

        .usr-pic {
            width: 110px;
            height: 110px;
            margin: 0 auto;
            margin-bottom: 0px;
            margin-bottom: -48px;
        }

        .usr-pic > img {
            border: 5px solid #fff;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            -ms-border-radius: 100px;
            -o-border-radius: 100px;
            border-radius: 100px;
            width: 100%;
            height: 100%;
        }

        .user-specs {
            padding:63px 0 0 0;
        }

        /* Timeline */
      
        .timeline {
            white-space: nowrap;
            border-left: 4px solid #004ffc;
            border-bottom-right-radius: 4px;
            border-top-right-radius: 4px;
            background: rgba(255, 255, 255, 0.03);
            color: rgba(255, 255, 255, 0.8);
            font-family: 'Chivo', sans-serif;
            margin: 20px 50%;
            letter-spacing: 0.5px;
            position: relative;
            line-height: 1.4em;
            font-size: 1.03em;
            padding: 50px;
            list-style: none;
            text-align: left;
            font-weight: 100;
            max-width: 30%;
        }

        .timeline .event {
            border-bottom: 1px dashed rgba(255, 255, 255, 0.1);
            padding-bottom: 25px;
            /* margin-bottom: 50px; */
            position: relative;
            color: red;
            /* clear: both; */
            z-index: 2;
        }
       
        .timeline .event::after {
            box-shadow: 0 0 0 4px #004ffc;
            left: -57.85px;
            background: whitesmoke;
            border-radius: 50%;
            height: 11px;
            width: 11px;
            content: "";
            top: 5px;
        }
        .timeline .event::before, .timeline .event::after {
            position: absolute;
            display: block;
            top: 35px;
        }
        .timeline .event::before {
            left: -217.5px;
            color: rgba(255, 255, 255, 0.4);
            text-align: right;
            font-weight: 100;
            font-size: 0.9em;
            min-width: 120px;
            font-family: 'Saira', sans-serif;
        }
        .timeline .event:nth-of-type(odd)::before {
            left: -164px; 
        }
        .timeline .event::before{
            content: "";
            width: 100%;
            height: 2px;
            background-color: #004ffc;
            left: -44px;
            top: 40px;
            z-index: -1;
        }
        .timeline .event:nth-of-type(odd) p{
            border-right: 3px solid #004ffc;
            margin-left: -389px;
            border-left: none;
        }
        .timeline .event p {
            padding: 1rem;
            border-radius: 2px;
            border-left: 3px solid #004ffc;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .12), 0 1px 2px 0 rgba(0, 0, 0, .24);
            background-color: white;
            width: 273px;
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .col-sm-8 .card .card-body{
            background: whitesmoke;
            max-height: 369px;
            overflow: auto;
        }
        .timeline .event p span{
            font-size: 11.4px;
            font-style: italic;
            color: #939ba2;
            text-transform: capitalize;
            float: inline-end;
        }
    </style>

@endsection
@section('content')
    <ol class="breadcrumb has-background-white">
        <li class="breadcrumb-item"><a href="/dashboard">{{ $record->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
    </ol>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            {{ $message }}
        </div>
    @endif
    <div class="row">

        <div class="col-sm-4">
            <div class="card">
                <div class="card-header username-dt ">
                    <div class="usr-pic">
                        <img src="{{ asset(($record->avatar== NULL ? 'img/profile.png':'upload/avatar/compress/'.$record->avatar ) )}}" alt="" srcset="">
                    </div>
                </div>
                <div class="card-body user-specs table-responsive" >
                    <table class="table table-striped table-bordered table-sm">
                    
                        <tr>
                            <th>Name</th>
                            <td>{{ $record->name }}</td>
                        </tr>
                        <tr>
                            <th>Mobile Number</th>
                            <td>{{ $record->pnumber }}</td>
                        </tr>
                        <tr>
                            <th>Post Title</th>
                            <td>{{ $record->ptitle }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $record->email }}</td>
                        </tr>
                        <tr>
                            <th>Home Address</th>
                            <td>{{ $record->address }}</td>
                        </tr>                        
                        <tr>
                            <th>Date Assigned</th>
                            <td>{{ date_format(date_create($record->created_at ),"l jS \of F Y") }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">Footer</div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">Recent  Log</div>
                <div class="card-body">
                    <ul class="timeline">
                        @foreach($log as $logs)
                            <li class="event">
                                <p>
                                    {{ $logs['stafflog'] }}
                                    <?php 
                                        $date1=date_create($logs['created_at']);
                                        $date1=date_create("2013-03-15");
                                        $diff=date_diff(date_create($logs['created_at']),date_create());
                                        if($diff->format("%y") > 0)$timedat=$diff->format("%y").' year'. ($diff->format("%y") > 1?'s':'');
                                        elseif($diff->format("%m") > 0)$timedat=$diff->format("%m").' month'. ($diff->format("%m") > 1?'s':'');
                                        elseif($diff->format("%d") > 0)$timedat=$diff->format("%d").' day'. ($diff->format("%d") > 1?'s':''); 
                                        elseif($diff->format("%h") > 0)$timedat=$diff->format("%h").' hour'. ($diff->format("%h") > 1?'s':''. $diff->format("%i").' minutes');
                                        else $timedat= $diff->format("%i").' minutes';
                                    ?><br>
                                    <span><i class="fa fa-clock-o"></i> {{ $timedat.' Ago'}}</span>
                                </p>
                            </li>
                        @endforeach
                        
                    </ul>
                </div>
            </div>
        </div>
    </div> 
@endsection