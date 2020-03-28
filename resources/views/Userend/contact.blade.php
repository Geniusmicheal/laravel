@extends('Userend/layout')
@section('style')
    <style>
        .page-top-banner .overlay-bg{

            background-image: linear-gradient(to right bottom, rgba(0, 0, 20, 0.8), rgba(50, 0, 90, 0.9)), url(../img/lagos3.png);  
            background-size: cover;
            background-position: center;
        }

        .page-top-banner {
            background: url(../img/about-header.jpg);
            background-size: cover;
        }
        .page-top-banner .overlay-bg {opacity: .8;}
        .page-top-banner h1 {
            color: #fff;
            font-size: 55px;
            margin-bottom: 10px;
        }
        .page-top-banner h4 {
            color: #000;
            font-weight: 400;
        }
        .section-gap-full {padding: 120px 0;}
        .relative {position: relative;}

        .blog-section .overlay-bg {
            background: rgba(34, 34, 34, 0.2);
            z-index: 1;
        }

        .section-gap-half {padding: 120px 0px 0;}
        .text-center {text-align: center;}
        .page-top-banner .overlay-bg {opacity: .8;}
        h1:hover {color: blue;}
        .page-top-banner .overlay-bg {

            background: #007bff;
            background-size: cover;
            background-position: center;
        }
        .overlay {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }
        .contact-section .section-title {padding-top: 120px;}
        .padding-top-120 {padding-top: 120px;}
        .contact-page-section {background: #eee !important;}
        .contact-page-section .single-address-col .div {
            padding: 30px 0px;
            border-radius: 5px;
            background: #fff;
            margin-bottom: 40px;
        }
        .justify-content-center {
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
        .form-row {
            background: #fff;
            padding: 30px 0px;
            border-radius: 3px;
            margin-bottom: -100px;
            box-shadow: 0px 0px 158px 0px rgba(0, 0, 0, 0.11);
            -webkit-box-shadow: 0px 0px 158px 0px rgba(0, 0, 0, 0.11);
            -moz-box-shadow: 0px 0px 158px 0px rgba(0, 0, 0, 0.11);
        }

        .form-row .message {
            height: 50px;
            width: 100%;
            font-size: 13px;
            line-height: 50px;
            text-align: center;
            float: none;
            margin-top: 20px;
            display: none;
            color: #fff;
        }
        .form-row .error {background: #ef5659;}
        .form-row .success {background: #691cff;}
        .contact-form-wrap {padding: 50px;}
        .contact-form-wrap .form-col {margin-bottom: 30px;}
        .contact-form-wrap .form-control {
            border-radius: 0px;
            border-top: none;
            border-left: none;
            border-right: none;
            background: transparent;
            padding-left: 0px;
        }
        .contact-form-wrap .form-control:focus {
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border-color: #222 !important;
        }
        .contact-form-wrap .btn-primary:focus {outline: none;}
        .contact-form-wrap .btn-primary{
            margin-top: 30px;
            border: none;
        }

        .btn-primary {
            border-radius: 5px;
            padding: 15px 40px;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }

        .btn-primary:hover {
            color: #fff;
            -webkit-box-shadow: 0px 30px 90px rgba(105, 28, 255, 0.14) !important;
            box-shadow: 0px 30px 90px rgba(105, 28, 255, 0.14) !important;
            -ms-transform: translateY(-2px);
            transform: translateY(-2px);
            -webkit-transform: translateY(-2px);
        }
    </style>
@endsection
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>	
            {{ $message }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Start page-top-banner section -->
    <section class="page-top-banner section-gap-full relative" data-stellar-background-ratio="0.5">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row section-gap-half" style="padding:0px;">
                <div class="col-lg-12 text-center">
                    <p><h4>Are you in need of a Social Media Marketing,<br>  Content Writing and, Voiceover Artist and Advert?<br> 9javiews is here to carry you along and make you happy.</h4></p>
                    <h1>Contact Us </h1>
                    <h4>9javiewsng@gmail.com</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-top-banner section -->

    <section class="contact-section contact-page-section padding-top-120" id="contact-section">
        <div class="container">
        <div class="row justify-content-center form-row">
                <div class="col-lg-9">
                    <form method="post" action="{{ route('usercontact') }}">
                        {{ csrf_field() }}
                        <div class="row contact-form-wrap justify-content-center">
                            <div class="col-md-6 contact-name form-col">
                                <input name="name"  class="form-control" type="text" placeholder="Name*"
                                    onfocus="this.placeholder=''" onblur="this.placeholder='Name*'" required>
                            </div>
                            <div class="col-md-6 contact-email form-col">
                                <input name="mail" required class="form-control" type="email" placeholder="E-mail*"
                                    onfocus="this.placeholder=''" onblur="this.placeholder='Email*'">
                            </div>
                            <div class="col-lg-12">
                                <textarea name="comment" required class="form-control" rows="8" placeholder="Message"
                                    onfocus="this.placeholder=''" onblur="this.placeholder='Message*'"></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Send Message">
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </section>
@endsection