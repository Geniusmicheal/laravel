<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png') }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>9javiews</title>
        <style>
            body{
                background-color: #343a40 !important;
                height: 100vh;
            }
            .card{
                max-width: 540px;
                margin: 0vh auto;
            }
            .card-body{
                padding: 1.25rem;
            }
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    </head>
    <body>
        <div class="container" style="padding-top:8vh;">
            <div class="card">
                <header class="card-header">Admin Login</header>
                <div class="card-body">
                    <?=(Session::get('error') != NULL )? '<div class="alert alert-danger">'.Session::get('error').'</div>':'' ?>
                    <form  method="post" class="needs-validation {{ (Session::get('error') != NULL  || Session::get('errors') != NULL ?'was-validated':'') }}" action="{{ route('stafflogin')}}" autocomplete="off">
                        <input type="hidden" name="locat" id="locat">
                        {{ csrf_field() }}  
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                            @if($errors->get('email')!= NULL)
                                <div class="invalid-feedback">{{ $errors->get('email')[0] }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
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
                            <input type="submit" value="Login" class="btn btn-success form-control">
                        </div>
                    </form>
                </div>
                <div class="card-footer">Footer</div>
            </div>
        </div>

        <script>
        
            const submitButton = document.querySelector("input[type='submit']");
            var forms = document.getElementsByTagName('form');
            
            submitButton.addEventListener("click", function(){
                let i=0;
                for (i; i< forms[0].length; i++){
                    if(forms[0][i].validity.valid==false)
                    forms[0].classList.add('was-validated');
                }
            });
            // document.getElementById("locat").value = navigator.platform
            // if (navigator.geolocation) {
            //     navigator.geolocation.getCurrentPosition(function(position) {
            //         myLatt = position.coords.latitude;
            //         myLng = position.coords.longitude;
            //         const lyricsResponse =  fetch('http://us1.locationiq.com/v1/reverse.php?key=9421003a053d41&lat='+ myLatt+'&lon='+myLng+'&format=json').then(data=>{
            //             return data.json();
            //         }).then(result=>{
            //         document.getElementById("locat").value = result.address.state+', '+ result.address.country;
            //         // console.log(document.getElementById("locat").value );
            //         });
                    
            //     });

            // }
        </script>
        
     
    </body>
</html>