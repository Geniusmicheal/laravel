@extends('Userend/layout')
@section('style')
    <style>
        /* .row{padding-top:100px !important; } */
        .section-gap-full {padding: 20px 0 !important;}
        .cover {
            background: url("{{ asset('upload/event/original/'.$content->banner) }}") center no-repeat;
            height: 300px; 
            background-size: cover;
            background-size: 100%;
            margin-top: 60px;
            
        }
        .row .msg-detail img{
            content: "";
            clear: both;
            display: table;
            /* float: left;
            width: 35px;
            position: relative;
            border-radius: 100%;
            height: 35px; */
        }

        .delete{
            background-color: white;
            border-color: #dbdbdb;
            border-radius: 2px;
            font-size: 0.75rem;
            padding: calc(0.375em - 1px) 0.75em;
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="card widget">
        <div class="card-body">
            {!! html_entity_decode($content->about) !!}
            <?php if($content->youtube_url): ?>
                <iframe style="width:100%; height: 300px;"  src="{{$content->youtube_url}}?controls=1" ></iframe>
            <?php endif; ?>
        </div>
    </div>

    <div class="card ">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 top-user-widget">
                    <h4>Organizer</h4>
                    <?php 
                        $sponsors = explode(',',$content->sponsor_by);
                        foreach($sponsors as $sponsor):
                            $name= explode('_',$sponsor); 
                    ?>
                        <div class="msg-detail" style="padding-bottom: 20px;">                                  
                            <img src="{{ asset('upload/event/compress/'.$sponsor) }}">
                            <div class="usr-info">
                                <h3>{{ $name[0] }}</h3>
                                <p> <i class="fa fa-clock-o"></i> Monday 9th of December 2019</p>
                            </div>
                        </div><br>
                    <?php endforeach; ?>

                </div>
                <div class="col-sm-6">       
                    <h4>Official Links</h4>
                    <a href="{{ $content->website }}" class="btn delete">Official Website </a><br>
                    <p class="btn delete">{{ $content->email }}</p>
                    <p class="btn delete">{{ $content->num_phone }}</p>
                    <p class="btn delete">{{ $content->office }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection