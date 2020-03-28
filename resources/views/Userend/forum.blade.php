@extends('Userend/layout')
@section('style')
    <style>
        .nav-item{padding:0px !important; }
    </style>
@endsection
@section('content')

<div class="card widget">
    <div class="card-body">
        <ul class="nav nav-tabs nav-justified " role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab"><h4 class="widget-title">Login</h4></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab"><h4 class="widget-title">Signup</h4></a>
            </li>
        </ul>
    
        <div class="tab-content">
            <div class="error" style="margin: 25px 0px 0px;">
                <?=(Session::get('error') != NULL )? '<div class="alert alert-danger">'.Session::get('error').'</div>':'' ?>
                @if($errors->any())
                    <br>
                    <div class="alert alert-danger ">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li style="padding: 0px; float: none;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div  class="tab-pane active">


                <form action="{{ route('userlogin')}}" method="post" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}"  autocomplete="off">
                    {{ csrf_field() }}  
                    <div class="form-group">
                        <label for="usr">Username:</label>
                        <input type="text" class="form-control" placeholder="Username" required name="username">
                        @if($errors->get('username')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('username')[0] }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" placeholder="password" required name="password">
                        @if($errors->get('password')!= NULL)
                            <div class="invalid-feedback">{{ $errors->get('password')[0] }}</div>
                        @endif
                    </div> 

                    <div class="custom-control custom-checkbox mb-3" style="float: left !important;">
                        <input type="checkbox" class="form-check-input" id="customCheck" name="example1">
                        <label class="custom-control-label" for="customCheck"> Remember me</label>
                    </div>
                    <div style="float: right !important;">
                        <a href="http://">Forget Password?</a>
                    </div>
                    <div class="clearfix"></div>


                    <div>
                        <input type="submit" value="Login" class="btn btn-primary" name="login">
                    </div>
                </form>
            </div>

            <div class="tab-pane fade">
                <form  action="{{ route('usersignup') }}" method="post" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}"  autocomplete="off">
                    {{ csrf_field() }}  
                    <div class="form-group">
                        <label for="usr">Username</label>
                        <input type="text" class="form-control" placeholder="Username" required name ="username">
                    </div>
            
                    <div class="form-group">
                        <label for="usr">Email:</label>
                        <input type="text" class="form-control" placeholder="User Email" required name="email">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" placeholder="password" required name="password"> 
                    </div> 
                    
                    <div class="form-group">
                        <label for="pwd">Password Confirmation</label>
                        <input type="password" class="form-control" placeholder="password" required name="password_confirmation">
                    </div> 
                    
                    <div>
                        <input type="submit" value="Signup" class="btn btn-primary" name="signup">
                    </div>
                </form>
            </div><br><br>

        </div>
    </div>
</div>
@endsection

@section('script')
//<script>
    const navlink =document.querySelectorAll('.nav-link[data-toggle=tab]');
    const navtab = document.querySelectorAll('.tab-pane');

    var forms = document.querySelectorAll('form');
    const loginButton = forms[0].querySelector("input[type='submit']");
    const signupButton = forms[1].querySelector("input[type='submit']");

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

    loginButton.addEventListener("click", () => { inputform(0); });
    signupButton.addEventListener("click", () => { inputform(1); });

    function inputform(id){
        for (let i=0; i< forms[id].length; i++){
            if(forms[id][i].validity.valid==false)
            forms[id].classList.add('was-validated');
        }
    }

//<script>
@endsection