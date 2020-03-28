@extends('Userend/layout')
@section('style')
    <style>
        .note-toolbar {z-index:0 !important ;}
        .note-editor.note-frame .note-editing-area .note-editable{height: 297px;}
    </style>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

@endsection
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            {{ $message }}
        </div>
    @endif
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
    <form  method="post" enctype="multipart/form-data" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}"  action="{{ isset($result)?route('editupload',['id'=>$result->news_id] ) : route('insertupload') }}">
        {{ csrf_field() }} 
        <input type="hidden" name="exImg" value="{{ isset($result)? $result->newsImage:'' }}">
        <input type="hidden" name="type" value="{{ $type }}">
        <div class="card">
            <div class="card-body" >
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="News Headline" minlength="5" required value="{{ isset($result)? $result->headline:'' }}" name="headline">
                    @if($errors->get('headline')!= NULL)
                        <div class="invalid-feedback">{{ $errors->get('headline')[0] }}</div>
                    @endif
                </div>

                <select class="form-control" name="country" required>
                    <option disabled {{ isset($result)?'':'selected' }}>Select News Country</option>
                    @foreach($location as $locations)
                        <option value="{{$locations->location_id}}" {{ (isset($result) && $result->location_id == $locations->location_id) ? 'selected' : '' }}>
                            {{$locations->location}}
                        </option>
                    @endforeach
                </select><br>
                
                <div class="custom-file form-group">
                    <input type="file" class="custom-file-input" id="customFile" name="customFile" {{ isset($result)? '' :'required' }}>
                    <label class="custom-file-label" for="customFile">
                        {{ isset($result)?'Single file selected ' :'News Content Image' }}
                    </label>
                </div>
                <br><br>

                <div class="form-group">
                    <!-- <label >Short News Content</label> -->
                    <textarea id="summernote" name="editordata" class="form-control" required>{{ isset($result)? html_entity_decode($result->content):'' }}</textarea>
                </div>

                <div class="form-group pull-right">
                    <input type="submit" class="btn btn-primary" value="{{ isset($result)?'Edit News':'Upload News' }}">
                </div>
            </div>
        </div>

    </form>
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
            if(forms[1][i].validity.valid==false)
            forms[0].classList.add('was-validated');
        }
    });


//</script>
@endsection