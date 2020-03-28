@extends('Backend/layout')
@section('style')
    <style>
        .card{
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-top: 3px solid #00c0ef;
        }
        .form-control-sm{width: 220px;}

        .user-photo-action {
            background-color: rgba(255, 255, 255, 0.85);
            bottom: -30px;
            color: #363636;
            left: 15px;
            padding: 8px 0px;
            position: absolute;
            text-align: center;
            right: 15px;
            -webkit-transition:bottom .3s ease-in-out;
            transition: bottom .3s ease-in-out;
            cursor: pointer;
        }
        .card-body{padding: 30px 35px;}

        .col-sm-4 img{
            width: 345px;
            height: 300px;
            cursor: pointer;
        }
        .col-sm-4 {overflow: hidden}
    </style>





@endsection
@section('content')
    <ol class="breadcrumb has-background-white">
        <li class="breadcrumb-item"><a href="#">{{ $record->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
    </ol>

    <div class="card">
        <div class="card-header"></div>
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
            <form  method="post" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}" action="{{ route('staffeditprofile') }}" enctype="multipart/form-data">

                <div class="row">
                    {{ csrf_field() }}  
                    <div class="col-sm-4">
                        <img class="img-fluid" src="{{ asset(($record->avatar== NULL ? 'img/profile.png':'upload/avatar/compress/'.$record->avatar ) )}}" alt="Chania" >
                        <span class="user-photo-action">Click here to reupload</span>
                        <input type="file" name="profile" style="display: none">
                    </div>
                    
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" class="form-control"  placeholder="Full Name" minlength="5" required value="{{ $record->name }}" name="fullname">
                            @if($errors->get('fullname')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('fullname')[0] }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Phone Number</label>
                            <input type="text" class="form-control" placeholder="Phone Number" required pattern="[0-9]{11}" value="{{ $record->pnumber }}" name="pnumber" >
                            @if($errors->get('pnumber')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('pnumber')[0] }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Home Address</label>
                            <input type="text" class="form-control" minlength="12" placeholder="Home Address" required value="{{ $record->address}}" name="address">
                            @if($errors->get('address')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('address')[0] }}</div>
                            @endif
                        </div>
                        <div class="form-group pull-right">
                            <input type="submit" class="btn btn-primary" value="Update Profile">
                        </div>
                    </div>
                
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
//<script>
    const submitButton = document.querySelector("input[type='submit']");
    let  avatar = document.querySelector(".col-sm-4");
    let avatarInput = document.querySelector("input[type='file']");
    let forms = document.getElementsByTagName('form');
    
    submitButton.addEventListener("click", ()=>{
        let i=0;
        for (i; i< forms[0].length; i++){
            if(forms[0][i].validity.valid==false)
            forms[0].classList.add('was-validated');
        }
    });

    avatar.addEventListener('mouseover',()=>{
        document.querySelector(".user-photo-action").style.bottom= '12px';
    });
    avatar.addEventListener('mouseout',() => {
        document.querySelector(".user-photo-action").style.removeProperty("bottom");
    });
    avatar.addEventListener('click',() => {avatarInput.click();});

    avatarInput.addEventListener('change',function(){
        var extension = this.value.substring(this.value.lastIndexOf('.') + 1).toLowerCase();
        if (extension == "png" || extension == "jpeg" || extension == "jpg") {
            var obj= new FileReader();
            obj.onload= function(data){
                document.querySelector(".img-fluid").src=data.target.result;
            }
            obj.readAsDataURL(this.files[0]);
            document.querySelector(".error").innerHTML='';

        }else{
            document.querySelector(".error").innerHTML=`<div class="alert alert-danger alert-dismissible fade show"> 
                Invalid profile image ${this.files[0].name} . Note, valid extension must be <b>"png","jpeg","jpg"</b></div>`;
            this.value='';
            var scrollStep = -window.scrollY / (1000/ 15),
            scrollInterval = setInterval(() => {
                if ( window.scrollY != 0 ) window.scrollBy( 0, scrollStep );
                else clearInterval(scrollInterval); 
            },15);
 
        } 
    });
//</script>
@endsection
