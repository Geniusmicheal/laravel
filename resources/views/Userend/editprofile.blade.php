@extends('Userend/layout')
@section('style')
    <style>
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

        .col-sm-4 img{
            width: 345px;
            height: 300px;
            cursor: pointer;
        }
        .col-sm-4 {overflow: hidden}
    </style>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="error">
                @if($errors->any())
                    <div class="alert alert-danger ">
                        @if ($message = Session::get('error'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>	
                                {{ $message }}
                            </div>
                        @endif
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form  method="post" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}" action="{{ route('updateprofile') }}" enctype="multipart/form-data">
                <div class="row" style="padding-top:0px !important;">
                    {{ csrf_field() }}  
                    <div class="col-sm-4">
                        <img src="{{ ($user->img== '') ? asset('img/profile.png') : asset('upload/user/compress/'.$user->img) }} "  class="img-fluid">
                        <span class="user-photo-action">Click here to reupload</span>
                        <input type="file" name="profile" style="display: none">
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <!-- <label >Username</label> -->
                            <input type="text" class="form-control"  placeholder="Username" minlength="5" required value="{{ $user->username }}" name="username">
                            @if($errors->get('username')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('username')[0] }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <!-- <label >Email</label> -->
                            <input type="text" class="form-control"  placeholder="Email" minlength="5" required value="{{ $user->email }}" name="email">
                            @if($errors->get('email')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('email')[0] }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <!-- <label >Phone Number</label> -->
                            <input type="text" class="form-control"  placeholder="Phone Number" minlength="5" pattern="[0-9]{11}" value="{{ $user->phone_number }}" name="phone_number">
                            @if($errors->get('phone_number')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('phone_number')[0] }}</div>
                            @endif
                        </div>
                        <?php  $social = explode('~',$user->social_media); ?>
                        <div class="form-group">
                            <!-- <label >Phone Number</label> -->
                            <input type="url" class="form-control"  placeholder="Facebook Link" minlength="5" value="{{ (isset($social[1]))?$social[1]:'' }}" name="facebook">
                            @if($errors->get('facebook')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('facebook')[0] }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <!-- <label >Phone Number</label> -->
                            <input type="url" class="form-control"  placeholder="Twitter Link" minlength="5" value="{{ $social[0] }}" name="twitter">
                            @if($errors->get('twitter')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('twitter')[0] }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <!-- <label >Phone Number</label> -->
                            <input type="text" class="form-control"  placeholder="Occupation" value="{{ $user->occupation }}" name="occupation">
                            @if($errors->get('occupation')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('occupation')[0] }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label >Date Of Birth</label>
                            <input type="date" class="form-control"  placeholder="Dob" value="{{ $user->dob }}" name="dob">
                            @if($errors->get('dob')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('dob')[0] }}</div>
                            @endif
                        </div>

            
                        <div class="form-group">
                            <!-- <label>Home Address</label> -->
                            <input type="text" class="form-control" placeholder="Current Location"  value="{{ $user->current_location}}" name="current_location">
                            @if($errors->get('current_location')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('current_location')[0] }}</div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>About Me</label>
                            <textarea name="about" rows="5" class="form-control">{{ $user->about }}</textarea>
                            @if($errors->get('about')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('about')[0] }}</div>
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
