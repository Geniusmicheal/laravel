@extends('Backend/layout')
@section('style')
    <style>
        .card{
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-top: 3px solid #00c0ef;
            word-wrap:normal;
            margin-bottom: 30px;

        }
        .card-footer {padding: .75rem 1.25rem 0px 1.25rem; }
        .note-toolbar {z-index:0 !important ;}
        .note-editor.note-frame .note-editing-area .note-editable{height: 297px;}
       
    </style>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
@endsection
@section('content')
    <ol class="breadcrumb has-background-white">
        <li class="breadcrumb-item"><a href="/dashboard">{{ $record->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('staffoverview') }}">News Overveiw</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            {{ isset($result)?'Edit':'Add' }} News
        </li>
    </ol>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            {{ $message }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <i class="fa fa-pencil-square-o" ></i>
            {{ isset($result)?'Edit':'Add' }} News
        </div>
        <div class="card-body">
            <div class="error">
                @if($errors->any())
                    <div class="alert alert-danger ">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form  method="post" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}" action="{{ isset($result)?route('staffEditNews',['id'=>$result->news_id] ) : route('staffAddNews') }}" enctype="multipart/form-data">
                <input type="hidden" name="exImg" value="{{ isset($result)? $result->newsImage:'' }}">
                <div class="row">
                    {{ csrf_field() }}  
                    
                    <div class="col-sm-8 form-group">
                        <input type="text" class="form-control"  placeholder="News Headline" minlength="5" required value="{{ isset($result)? $result->headline:'' }}" name="headline">
                        @if($errors->get('headline')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('headline')[0] }}</div>
                        @endif
                    </div>
                    <div class="col-sm-4 form-group">
                        <select class="form-control" required name="category">
                            <option disabled {{ isset($result)?'':'selected' }}>Select News Category</option>
                            @foreach($category as $categorys)
                                <option value="{{$categorys->category_id}}" {{ (isset($result) && $result->category_id == $categorys->category_id) ? 'selected' : '' }}>
                                    {{$categorys->category}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2 form-group">
                        <select class="form-control" name="home" required>
                            <option disabled {{ isset($result)?'':'selected' }} value="0">News Section</option>
                            <option value="2" {{ (isset($result) && $result->home == 2) ? 'selected' : '' }}>Trending</option>
                            <option value="1" {{ (isset($result) && $result->home == 1) ? 'selected' : '' }}>Front Page</option>
                            <option value="0" {{ (isset($result) && $result->home == 0) ? 'selected' : '' }}>None of the above</option>
                        </select>
                    </div>

                    <div class="col-sm-4 form-group">
                        <select class="form-control" name="country" required>
                            <option disabled {{ isset($result)?'':'selected' }}>Select News Country</option>
                            @foreach($location as $locations)
                                <option value="{{$locations->location_id}}" {{ (isset($result) && $result->location_id == $locations->location_id) ? 'selected' : '' }}>
                                    {{$locations->location}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6 form-group">
                        <input type="url" class="form-control"  placeholder="Source Url" minlength="5" value="{{ isset($result)? $result->source_url:'' }}" name="source_url">
                        @if($errors->get('source_url')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('source_url')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-8 form-group">
                        <input type="url" class="form-control"  placeholder="Media Download Url" minlength="5" value="{{ isset($result)? $result->download_url:'' }}" name="download_url">
                        @if($errors->get('download_url')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('download_url')[0] }}</div>
                        @endif
                    </div>

                    <div class="col-sm-4 custom-file form-group">
                        <input type="file" class="custom-file-input" id="customFile" name="customFile" {{ isset($result)? '' :'required' }}>
                        <label class="custom-file-label" for="customFile">
                            {{ isset($result)?'Single file selected ' :'News Content Image' }}
                        </label>
                    </div>

                    <div class="col-sm-12 form-group">
                        <label>Short News Content</label>
                        <textarea name="shortNews" class="form-control" required>{{ isset($result)? $result->short_content:'' }}</textarea>
                    </div>

                    <div class="col-sm-12 form-group">
                        <!-- <label >Short News Content</label> -->
                        <textarea id="summernote" name="editordata" class="form-control" required>{{ isset($result)? html_entity_decode($result->content):'' }}</textarea>
                    </div>
                    
                    <div class="form-group pull-right">
                        <input type="submit" class="btn btn-primary" value="{{ isset($result)?'Edit News':'Upload News' }}">
                    </div>
                </div>
               
            </form>
        </div>
    </div>
@endsection

@section('script')
//<script>
    const submitButton = document.querySelector("input[type='submit']");
    var forms = document.getElementsByTagName('form');
    let imgInput = document.querySelector("input[id='customFile']");

    $(document).ready(function() {
       $('#summernote').summernote();
    });

    imgInput.addEventListener('change',function(){
        var extension = this.value.substring(this.value.lastIndexOf('.') + 1).toLowerCase();
        if (extension == "png" || extension == "jpeg" || extension == "jpg") {
            document.querySelector(".custom-file-label").innerHTML = this.files[0].name;
            document.querySelector(".error").innerHTML='';

        }else{
            document.querySelector(".error").innerHTML=`<div class="alert alert-danger alert-dismissible fade show">Invalid News Content Image ${this.files[0].name}. Note, valid extension must be <b>"png","jpeg","jpg"</b></div>`;
            this.value='';
            var scrollStep = -window.scrollY / (1000/ 15),
            scrollInterval = setInterval(function(){
                if ( window.scrollY != 0 ) window.scrollBy( 0, scrollStep );
                else clearInterval(scrollInterval); 
            },15);
 
        } 
    });    
    submitButton.addEventListener("click", function(){
        let i=0;
        for (i; i< 8; i++){
            if(forms[0][i].validity.valid==false)
            forms[0].classList.add('was-validated');
        }
    });


//</script>
@endsection