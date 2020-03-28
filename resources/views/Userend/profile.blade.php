<!DOCTYPE html>
<html lang="zxx" class="no-js">

    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon-->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png') }}">
        <!-- Author Meta -->
        <meta name="author" content="Genius Micheal">
        <!-- Meta Description -->
        <meta name="description" content="">
        <!-- Meta Keyword -->
        <meta name="keywords" content="">
        <!-- meta character set -->
        <!-- Site Title -->
        <title>9javiews</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700" rel="stylesheet">
        <!--
        ============================================= -->
        <script src="https://kit.fontawesome.com/2025473456.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/af1cb1ae49.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ asset('css/generalFront.css') }}">
        <style>
            @media screen and (min-width: 902.5px){
                .container {max-width: 1152px;}
            }
            .username-dt {
                background-color: #007bff;
                padding-top: 40px;
            }
            .blog-lists-section .single-widget{padding: 20px !important;}
            .usr-pic {
                width: 110px;
                height: 110px;
                margin: 0 auto;
                margin-bottom: 0px;
                margin-bottom: -48px;
            }

            .usr-pic > img {
                border: 5px solid #fff;
                -webkit-border-radius: 100px;
                -moz-border-radius: 100px;
                -ms-border-radius: 100px;
                -o-border-radius: 100px;
                border-radius: 100px;
                width: 100%;
                height: 100%;
            }
            .user-specs {
                padding:63px 0 0 0;
            }
            .card{margin-bottom: 30px;}
            <?php if($search != 'event'): ?>
                .blog-lists-section .single-blog-post {
                    background: #fff;
                    border-radius: 5px;
                    -webkit-box-shadow: 0px 30px 90px rgba(0, 0, 0, 0.14) !important;
                    box-shadow: 0px 30px 90px rgba(0, 0, 0, 0.14) !important;
                    overflow: hidden;
                    margin-bottom: 30px;
                }
                .blog-lists-section .single-blog-post .post-details {padding: 30px;}

                .blog-lists-section .single-blog-post .tags li {
                    display: inline-block;
                    margin-right: 10px;
                }

                .blog-lists-section .single-blog-post .tags li a {
                    color: #0079fb;
                    font-weight: 600;
                    font-size: 14px;
                }

                .blog-details .user-details img {
                    width: 45px;
                    border-radius: 50px;
                }
                .blog-details .user-details p {
                    margin-bottom: 0px;
                }
                .blog-details .user-details .details {
                    margin-left: 8px;
                }
                .blog-lists-section .single-blog-post .user-details img {
                    width: 45px;
                    border-radius: 50px;
                }
                .blog-lists-section .single-blog-post .user-details p {
                    margin-bottom: 0px;
                }
                .blog-lists-section .single-blog-post .user-details .details {
                    margin-left: 8px;
                    font-family: "Poppins", sans-serif;
                    font-size: 14px;
                    font-weight: 300;
                }
                @media (max-width: 767px) {
                    .single-blog-post .post-details h1 {
                        font-size: 25px;
                    }
                }
                @media (max-width: 417px) {
                    .single-blog-post .post-details h1 {
                        font-size: 20px;
                    }
                }
            <?php endif; ?>
    
        </style>

    </head>
    <body >
        <nav class="navbar navbar-expand-sm fixed-top bg-white">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/logo.png') }}" class="img" >
            </a>

            <form class="form-inline" action="{{ route('usersearch',['id'=>$search ]) }}" style="width: 50%; margin-left: -12px;" method ="post">
                {{ csrf_field() }}  
                <div class="input-group" style="width: 100%">
                    <input type="text" class="form-control" placeholder="Search...." name="search">
                    <div class="input-group-append">
                        <span class="input-group-text" id="search">
                            <i class="fa fa-search" style="color: #4285f4;"></i>
                        </span>
                    </div>
                </div>
            </form>

            <div class="menu_bar">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <ul class="navbar-nav">
                @if(auth()->guard('user')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            Welcome {{ auth()->guard('user')->user()->username }}
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('newstags',['tag'=>'Politics']) }}">Politics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('newstags',['tag'=>'Entertainment']) }}">Entertainment</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('newstags',['tag'=>'event']) }}">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('newstags',['tag'=>'Sport']) }}">Sports</a>
                </li>

                @if(!auth()->guard('user')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('newstags',['tag'=>'forum']) }}">Signin</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('usercontact') }}">Contact us</a>
                </li>
                
                @if(auth()->guard('user')->check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbardrop">
                            <div class="msg-detail" style="float: left;">                                  
                                <img src="{{ (auth()->guard('user')->user()->img== '') ? asset('img/profile.png') : asset('upload/user/compress/'.auth()->guard('user')->user()->img)}}">
                                <div class="usr-info">
                                    <h3>{{ auth()->guard('user')->user()->username }}</h3>
                                    <p>{{ auth()->guard('user')->user()->occupation }}</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('userprofile',['id' => auth()->guard('user')->user()->username ]) }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('editprofile',['id' => auth()->guard('user')->user()->username ]) }}">Update profile</a>
                            <a class="dropdown-item" href="{{ route('userevent',['id' => auth()->guard('user')->user()->username ]) }}">Event</a>
                            <a class="dropdown-item" href="{{ route('userchangepassword',['id' => auth()->guard('user')->user()->username ]) }}">Change Password</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">LogOut</a>
                        </div>
                    </li>

                @endif

            </ul>
        </nav>

        <section class="blog-lists-section section-gap-full">
            <div class="container">
                
                <div class="row">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success col-sm-12">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            {{ $message }}
                        </div>
                    @endif
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header username-dt ">
                                <div class="usr-pic">
                                    <img src="{{ ($user->img== '') ? asset('img/profile.png') : asset('upload/user/compress/'.$user->img) }}" >
                                </div>
                            </div>
                            <div class="card-body user-specs table-responsive" >
                                <table class="table table-striped table-bordered table-sm">
                                    <tr>
                                        <th>Username</th>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>

                                    <tr>
                                        <th>Mobile Number</th>
                                        <td>{{ $user->phone_number }}</td>
                                    </tr>
                                    <?php  $social = explode('~',$user->social_media); ?>
                                    <tr>
                                        <td colspan="2">
                                            <i class="fab fa-twitter-square" style="color:#00aced"></i>    
                                            <a href="{{ $social[0] }}" target="_blank">
                                                {{ $social[0] }}
                                            </a>
                                        </td>
                                    </tr> 

                                    <tr>
                                        <th>Occupation </th>
                                        <td>{{ $user->occupation  }}</td>
                                    </tr> 

                                    <tr>
                                        <td colspan="2">
                                            <i class="fab fa-facebook-square" style="color:#00aced"></i>    
                                            <a href="{{ (isset($social[1]))?$social[1]:'' }}" target="_blank">
                                                {{ (isset($social[1]))?$social[1]:'' }}
                                            </a>
                                        </td>
                                    </tr> 

                                    <tr>
                                        <th>Dob</th>
                                        <td>
                                            {{ date_format(date_create($user->dob ),"l jS \of F Y") }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Current Location </th>
                                        <td>{{ $user->current_location  }}</td>
                                    </tr>

                                    <tr>
                                    <th>About Me</th>
                                        <td>{{ $user->about }}</td>
                                    </tr>    
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="blog-lists" >
                            <?php if($search =='event'): ?>
                                <?php foreach($content as $contents): 
                                    if(stripos($contents->event_date,'*')){
                                        $eventdate = explode('*', $contents->event_date);
                                        $from = date_format(date_create($eventdate[0]),"j\<\s\up>S\</\s\up> M") ;
                                        $to = date_format(date_create($eventdate[1]),"j\<\s\up>S\</\s\up> M Y");
                                        $evntdate = $from.' - '.$to;
                                    }else{ $evntdate = date_format(date_create($contents->event_date),"jS M Y");}
                                ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <p>{!! $evntdate  !!}</p>
                                            <p>
                                                <a href="{{ route('readnews',['type'=>'event','id'=>$contents->slug]) }}">{{ $contents->name }}</a>
                                            </p>
                                            {!!  html_entity_decode($contents->about) !!}
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('editNews',['type'=>'event','id'=>$contents->slug]) }}" class="btn delete">Edit</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php foreach($content as $contents): ?>
                                    <div class="single-blog-post">
                                        <div class="post-details">
                                            <ul class="tags">      
                                                <li>
                                                    <a href="{{ route('newstags',['tag'=>$contents->category]) }}">
                                                        {{ $contents->category }}
                                                    </a>
                                                </li>
                                                <li><a href="#">{{ $contents->location }} </a></li>
                                            </ul>
                                            <a href="{{ route('readnews',['type'=>$contents->category,'id'=>$contents->slug]) }}">
                                                <h1>{{ $contents->headline }}</h1>
                                            </a>
                                            <p>
                                                {{ $contents->short_content }}
                                                <a href="{{ route('readnews',['type'=>$contents->category,'id'=>$contents->slug]) }}">
                                                    Read More.......
                                                </a>
                                            </p>
                                            <div class="user-details d-flex align-items-center">
                                                <div class="user-img">
                                                    <img src="{{ asset('img/profile.png')  }}" alt="">
                                                </div>
                                                <div class="details">
                                                    <a href="#">
                                                        <h4>9javiews</h4>
                                                    </a>
                                                    <p>Sunday 22nd of September 2019</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                @if(count($content) > 10)
                                    <div class="card-footer">{{ $content->render() }}</div>
                                @endif
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar-wrap">
                            <div class="single-widget tags-widget">
                                <h4 class="widget-title">Sections</h4>
                                <ul>
                                    <li>
                                        <a href="{{ route('newstags',['tag'=>'event']) }}">Event</a>
                                    </li>
                                    <?php foreach($category as $categorys): ?>
                                        <li>
                                            <a href="{{ route('newstags',['tag'=>$categorys->category]) }}">{{ $categorys->category }}</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <?php if(isset($source)): ?>
                                <div class="single-widget react">
                                    <ul class='d-flex justify-content-between'>
                                        <li>
                                            <i class="fa fa-heart" style="color:#53d690"></i>
                                            <span id="totallike">{{ $like }}</span>
                                        </li>

                                        <li> 
                                            <i class="fa fa-comment" style="color:#e44d3a"></i>
                                            <span>{{$commentCount}}</span>
                                        </li>

                                        <li>
                                            <i class="fa fa-share-alt" style="color:#51a5fb"></i>
                                            <span>1185</span>
                                        </li>

                                        <li>
                                            <i class="fa fa-eye" style="color:#00b540"></i>
                                            <span id="totalunlike">{{ $unlike }}</span>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="single-widget recent-post-widget">
                                <h4 class="widget-title">Recent Posts</h4>
                                <ul>
                                    <li class="d-flex flex-row align-items-center">
                                        <div >
                                            <img src="https://9javiews.com.ng/upload/5cae283a1ae7c1a38ec87ed011efa1bc.jpg" alt="" style="width: 67.95px; height: 52.85px;">
                                        </div>
                                        <div class="details">
                                            <a href="#">
                                                <h5>
                                                    Imolites celebrates as Hope Uzodinma is declared winner of the 2019 Gubernatorial election
                                                </h5>
                                            </a>
                                            <p class="text-uppercase">15th January 2020</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="single-widget top-user-widget">
                                <h4 class="widget-title">Top User of the Week</h4>
                                <ul>
                                    <li class="d-flex justify-content-between">
                                        <div class="msg-detail">                                  
                                            <img src="{{ asset('img/logo.png') }}">
                                            <div class="usr-info">
                                                <h3>9javiews</h3>
                                                <p>Admin</p>
                                            </div>
                                        </div>
                                        <span>
                                            <i class="fas fa-award" style="color:red"></i>1223
                                        </span>
                                    </li>

                                    <li class="d-flex justify-content-between">
                                        <div class="msg-detail">                                  
                                            <img src="{{ asset('img/profile.png')  }}">
                                            <div class="usr-info">
                                                <h3>Genius Micheal</h3>
                                                <p>Web Developer</p>
                                            </div>
                                        </div>
                                        <span>
                                            <i class="fas fa-certificate" style="color:red"></i>12233
                                        </span>
                                    </li>

                                   
                                </ul>
                            
                            </div>


                            <div class="single-widget social-widget">
                                <h4 class="widget-title">Social Links</h4>
                                <ul>
                                    <li>
                                        <a target="_blank" href="#">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://twitter.com/9javiews_14">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="#">
                                            <i class="fab fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="#">
                                            <i class="fab fa-instagram" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="#">
                                            <i class="fab fa-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="scroll-top">
            <i class="fa fa-angle-up"></i>
        </div>
        <div class="card footer">
            <div class="card-body">
                <ul class="d-flex flex-row">
                    <li class="tags"><b>9javiews</b> All Rights Reserved!</li>
                    <li class="tags"><a href="">About us</a></li>
                    <li class="tags"><a href="">Privacy Policy</a></li>
                    <li class="tags">Copyright © 2004 - {{ date("Y") }}</li>
                </ul>
            </div>
        </div>
    </body>
    <script>
        const navbar =document.querySelector(".menu_bar");
        const siderbar =document.querySelector(".navbar-nav");
        const tag_widget =document.querySelector('.tags-widget');
        const scroll_top =document.querySelector('.scroll-top');
        
        // console.log(tag_widget);

        @if(auth()->guard('user')->check())
            const dropdown_menu = document.querySelector(".dropdown .dropdown-menu");
        
            document.querySelector("#navbardrop").onclick = () => {
                if(dropdown_menu.style.display == "block")dropdown_menu.removeAttribute('style');
                else dropdown_menu.style.display = "block";
            }
        @endif
        
        window.addEventListener("resize",  () =>{
            if(window.matchMedia("screen and (max-width: 912.5px)").matches)siderbar.style.width="0px";
            else siderbar.removeAttribute('style');
            
            if(window.matchMedia("screen and (max-width: 991px)").matches)
                document.querySelector(".col-lg-8").insertBefore(tag_widget,document.querySelector(".blog-lists") );
            else  document.querySelector(".sidebar-wrap").insertBefore(tag_widget,document.querySelector(".recent-post-widget") );
        });
        
        window.addEventListener("scroll", function() { 
            if(this.scrollY >= 554)
                scroll_top.style.display='block';
            else scroll_top.removeAttribute('style');
        });

        scroll_top.addEventListener("click", function() {
            window.scroll({ top: 0, behavior: 'smooth' });
        });

        if(screen.width <= 991)
        document.querySelector(".col-lg-3").insertBefore(tag_widget,document.querySelector(".card") );

        navbar.addEventListener("click",() => {
            navbar.classList.toggle("change");
            if(siderbar.style.width==="300px")siderbar.style.width="0px";
            else siderbar.style.width="300px";
        });

        document.querySelector("#search").addEventListener("click",() => {
            document.querySelector(".form-inline").submit();
        });
    </script>

</html>