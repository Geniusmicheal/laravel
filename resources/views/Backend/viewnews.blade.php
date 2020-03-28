@extends('Backend/layout')
@section('style')
    <style>
        .card{
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            /* border-top: 3px solid #00c0ef; */
            word-wrap:normal;
            margin-bottom: 30px;
            height: 500px;
        }
        .tab-content{overflow: auto;}
        .card-header {background-color: transparent;}
        .form-control-sm{width: 220px;}
        .card-footer {padding: .75rem 1.25rem 0px 1.25rem; }

        .cover {
            background: url("{{ asset('upload/'.$result->newsImage) }}") center no-repeat;
      
            height: 300px; 
            background-position: top;
            background-repeat: no-repeat;
            background-size: cover;
            background-size: 100% 300px;
            margin: -15px;
            
        }
        tbody tr:first-child td, tbody tr:first-child th{border-top: none;}
        .card-footer ul {
            justify-content: space-between !important;
            display: flex;
        }
        td img{width: 100px;}
        .delete{
            background-color: white;
            border-color: #dbdbdb;
            border-radius: 2px;
            font-size: 0.75rem;
            padding: calc(0.375em - 1px) 0.75em;
        }
    </style>

@endsection
@section('content')
    <div class="cover"></div>
    <ol class="breadcrumb has-background-white" style="margin: -15px -15px 15px;">
        <li class="breadcrumb-item"><a href="/dashboard">{{ $record->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('staffoverview') }}">News Overveiw</a></li>
        <li class="breadcrumb-item active" aria-current="page">News</li>
    </ol>
    @if ($message = Session::get('delete'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            {{ $message }}
        </div>
    @endif
    <div class="row">

        <div class="col-sm-8" >
            <div class="card" style="padding: 25px;">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" >About News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Content</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="container tab-pane active table-responsive"><br>
                        <table class="table table-sm">
                            <tr>
                                <th>Headline</th>
                                <td>{{ $result->headline }}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $result->category }}</td>
                            </tr>

                            <tr>
                                <th>Country</th>
                                <td>{{ $result->location }}</td>
                            </tr>

                            <tr>
                                <th>Source</th>
                                <td>{{ $result->source }}</td>
                            </tr>

                            <tr>
                                <th>Source_url</th>
                                <td>{{ $result->source_url }}</td>
                            </tr>

                            <tr>
                                <th>Time Uploaded</th>
                                <td>{{ date_format($result->created_at,"h:i:sa") }}</td>
                            </tr>
                            
                            <tr>
                                <th>Date Uploaded</th>
                                <td>{{ date_format($result->created_at,"l jS \of F Y") }}</td>
                            </tr>

                            <tr>
                                <th>Short Content</th>
                                <td>{{ $result->short_content }}</td>
                            </tr>
                        </table>
                    </div>

                    <div id="menu1" class="container tab-pane fade"><br>
                        {!! html_entity_decode($result->content) !!}
                        <?php 
                            if(!empty(trim($result->download_url))):
                                $url = route('download',['id'=>base64_encode($result->download_url)]);
                                $ext = pathinfo($result->download_url, PATHINFO_EXTENSION);
                                if(strtolower($ext) =='mp3'):
                        ?>
                                <audio controls style="width: 100%;">
                                    <source src="{{ $result->download_url }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>

                            <?php endif;?>
                            <a href="{{ $url }}" class="btn btn-info" style="margin: 0px auto"> 
                                <span class="spinner-grow spinner-grow-sm"></span>
                                Download {{ $ext }}
                            </a>
                        <?php  endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">News Comment</div>
                <div class="card-body  table-responsive">
                    <table class="table table-sm">
                        @foreach($comment as $comments)
                            <tr>
                                <th> 
                                    <input type="button" class="btn delete" value="Delete" onclick="deleteRecord('{{ route('staffdelete' , [ 'id' => $comments->comment_id . '~comment~'.$comments->comments]) }} ')">
                                </th>
                                <td>
                                    @if(pathinfo($comments->comment, PATHINFO_EXTENSION))
                                        <img src="{{ (strpos($comments->comment, 'http') >= 0) ? $comments->comment : asset('upload/user/compress/'.$comments->comment) }}">
                                    @else {{ $comments->comment }} @endif
                                </td>
                            </tr>
                        
                        @endforeach
                       
                    </table>
                </div>
                <div class="card-footer">{{ $comment->render() }}</div>
            </div>
        </div>
    </div>

@endsection
@section('script')
//<script>
    const navlink =document.querySelectorAll('.nav-link');
    const navtab = document.querySelectorAll('.tab-pane');

    function deleteRecord(link){
        
        if (confirm("Press Ok to Delete or Cancel") == true) location.replace(link);
    }

    navlink[0].addEventListener("click",() => { tab(0); });
    navlink[1].addEventListener("click",() => { tab(1); });

    function tab(id){
        if(id==0) var act=1;
        else var act=0;
        
        navlink[act].classList.remove('active');
        navlink[id].classList.add('active');
        
        navtab[id].classList.remove('fade');
        navtab[act].classList.add('fade');
        
        navtab[act].classList.remove('active');
        navtab[id].classList.add('active');
        
    }

@endsection
