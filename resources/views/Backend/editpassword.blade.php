@extends('Backend/layout')
@section('style')

    <style>
        .card{
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-top: 3px solid #00c0ef;
            word-wrap:normal;

        }
    </style>

@endsection
@section('content')
    <ol class="breadcrumb has-background-white">
        <li class="breadcrumb-item"><a href="/dashboard">{{ $record->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
    </ol>
    <div class="card">
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
                <?=(Session::get('error') != NULL )? '<div class="alert alert-danger">'.Session::get('error').'</div>':'' ?>

            </div>
            <form  method="post" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}" action="{{ route('staffeditpassword') }}">
                {{ csrf_field() }} 
                <div class="form-group">
                    <label >Current Password</label>
                    <input type="password" class="form-control"  placeholder="Current Password" minlength="5" required  name="oldpassword">
                    @if($errors->get('oldpassword')!= NULL)
                        <div class="invalid-feedback">{{ $errors->get('oldpassword')[0] }}</div>
                    @endif
                </div> 

                <div class="form-group">
                    <label >New Password</label>
                    <input type="password" class="form-control"  placeholder="New Password" minlength="5" required  name="newpassword">
                    @if($errors->get('newpassword')!= NULL)
                        <div class="invalid-feedback">{{ $errors->get('newpassword')[0] }}</div>
                    @endif
                </div> 

                <div class="form-group">
                    <label >Re-type Password</label>
                    <input type="password" class="form-control"  placeholder="Re-type Password" minlength="5" required name="re_password">
                    @if($errors->get('re_password')!= NULL)
                        <div class="invalid-feedback">{{ $errors->get('re_password')[0] }}</div>
                    @endif
                </div> 

                <div class="form-group pull-right">
                    <input type="submit" class="btn btn-primary" value="Change Password">
                </div>
            </form>

        </div>

    </div>
@endsection

@section('script')
//<script>
    const submitButton = document.querySelector("input[type='submit']");
    let forms = document.getElementsByTagName('form');

    submitButton.addEventListener("click", function(){
        let i=0;
        for (i; i< forms[0].length; i++){
            if(forms[0][i].validity.valid==false)
            forms[0].classList.add('was-validated');
        }

        if(forms[0][2].value !== forms[0][3].value){
            document.querySelector(".error").innerHTML='<div class="alert alert-danger alert-dismissible fade show">'+
            'New Password and Re-type Password are different'+'</div>';
            forms[0][2].value = forms[0][3].value = '';
            forms[0].classList.add('was-validated');
        }

    });
//</script>
@endsection