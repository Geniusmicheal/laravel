
@extends('Userend/layout')
@section('style')
    <style>
        /* .nav-item{padding:0px !important; } */
        .card-body p:nth-child(3){
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* number of lines to show */
            -webkit-box-orient: vertical;
        }
        p{margin-bottom: 0.2rem;}

        .wid { margin-bottom: 10px;}

        .delete{
            background-color: white;
            border-color: #dbdbdb;
            border-radius: 2px;
            font-size: 0.75rem;
            padding: calc(0.375em - 1px) 0.75em;
        }

        .card-footer {
            background-color: transparent;
            padding:.4rem 1.25rem;
        }
    </style>
@endsection
@section('content')
    <?php foreach($content as $contents): 
        
        if(stripos($contents->event_date,'*')):
            $eventdate = explode('*', $contents->event_date);
            $from = date_format(date_create($eventdate[0]),"j\<\s\up>S\</\s\up> M") ;
            $to = date_format(date_create($eventdate[1]),"j\<\s\up>S\</\s\up> M Y");
            $evntdate = $from.' - '.$to;
        else: $evntdate = date_format(date_create($contents->event_date),"jS M Y");
        endif;
        
    ?>
        <div class="card wid">
            <div class="card-body">
                <p>{!! $evntdate  !!}</p>
                <p>
                    <a href="{{ route('readnews',['type'=>'event','id'=>$contents->slug]) }}">
                        {{ $contents->name }}
                    </a>
                </p>
                {!!  html_entity_decode($contents->about) !!}
            </div>
            <div class="card-footer">
                <a href="http://" class="btn delete">Interested</a>
            </div>
        </div>
    <?php endforeach; ?>
    @if(count($content) > 10)
        <div class="card-footer">{{ $content->render() }}</div>
    @endif
@endsection