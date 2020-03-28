<!DOCTYPE html>
<html lang="zxx" class="no-js">

    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon-->
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png') }}">
        <!-- Author Meta -->
        <meta name="author" content="Genius Micheal">
        <meta name="keywords" content="">
        <!-- meta character set -->
        
        <!-- Site Title -->
        <title>9javiews</title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700" rel="stylesheet">
        <!--
        ============================================= -->
        
        <!--<link rel="stylesheet" type="text/css" href="assets/font/css/all.css">-->
        <script src="https://kit.fontawesome.com/2025473456.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/af1cb1ae49.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ asset('css/generalFront.css') }}">
        @yield('style')
        <!-- <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css"> -->

    </head>
    <body>
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
                    <a class="nav-link" href="{{ route('newstags',['tag'=>'Sport']) }}">Sport</a>
                </li>

                @if(!auth()->guard('user')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('newstags',['tag'=>'forum']) }}">Sign-in</a>
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
        <?php if(isset($banner)): ?>
            <div class="javiews">
                <div class="text-box">
                    <h1 class="darlington">
                        <span class="nigeria">9javiews</span>
                        <span class="africa">is where life happens</span>
                    </h1>
                </div> 
            </div>
            <?php elseif(isset($content->office)): ?>
            <?php
                if(stripos($content->event_date,'*')):
                    $eventdate = explode('*', $content->event_date);
                    $from = date_format(date_create($eventdate[0]),"j\<\s\up>S\</\s\up> M") ;
                    $to = date_format(date_create($eventdate[1]),"j\<\s\up>S\</\s\up> M Y");
                    $evntdate = $from.' - '.$to;
                else: $evntdate = date_format(date_create($content->event_date),"jS M Y");
                endif;
                
            ?>
            <div class="cover"></div>
            <div class="container">
                <div class="card" style="margin-top: -55px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5>{{ $content->name }}</h5>
                                <span> 
                                    <b>Tickets:</b> Avilable 0 / {{ $content->tickets }} 
                                </span><br>
                                <span> <b>Entry Fees:</b> {{ $content->event_type }}</span><br>
                                <span><b>Category: </b>{{ $content->category }}</span><br>
                                <span><b>Location: </b>{{ $content->location }}</span>


                            </div>
                            <div class="col-sm-4">
                                <h5 style="margin: 0px;">Venue:</h5>
                                <p style="margin: 0px;">
                                    <i class="fa fa-map-marker" ></i>
                                    {{ $content->address }}
                                </p>
                                <h5 style="margin: 0px;">Date:</h5>
                                <p style="margin: 0px;">
                                    {!! $evntdate  !!}
                                </p>
                                <h5 style="margin: 0px;">Time:</h5>
                                <p style="margin: 0px;">
                                <i class="fa fa-clock-o"></i> 
                                {{ date_format(date_create($content->event_time), "h:i:sa") }}
                            </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>  

        <section class="blog-lists-section section-gap-full">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-lists" >@yield('content')</div>
                    </div>
                    <div class="col-lg-4">
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
                                <h4 class="widget-title">Trending Posts</h4>
                                <ul>
                                    <?php foreach($trending as $trend): ?>
                                        <li class="d-flex flex-row align-items-center">
                                            <img src="{{ asset('upload/'.$trend->newsImage) }}" alt="" style="width: 67.95px; height: 52.85px;">
                                            <div class="details">
                                                <a href="{{ route('readnews',['type'=>$trend->category,'id'=>$trend->slug]) }}">
                                                    <h5>{{ $trend->headline }}</h5>
                                                </a>
                                                <p class="text-uppercase">{{ date_format(date_create($trend->created_at),"l jS \of F Y") }}</p>
                                            </div>
                                        </li>

                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="single-widget top-user-widget">
                                <h4 class="widget-title">Top User of the Week</h4>
                                <ul>
                                    @foreach($top_user as $user_award)
                                        <li class="d-flex justify-content-between">
                                            <div class="msg-detail">  
                                                <a href="{{  route('userprofile',['id' => $user_award->username]) }}">                                
                                                    <img src="{{ ($user_award->img== NULL) ? asset('img/profile.png') : asset('upload/user/compress/'.$user_award->img) }}">
                                                    <div class="usr-info">
                                                        <h3>{{$user_award->username}}</h3>
                                                        <p>{{$user_award->occupation}}</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <span>
                                                <i class="fas fa-award" style="color:red"></i>
                                                {{$user_award->vote}}
                                            </span>
                                        </li>
                                    @endforeach
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
                    <li class="tags"><a href="{{  route('userpolicy') }}">Privacy Policy</a></li>
                    <li class="tags">Copyright © 2019  - {{ date("Y") }}</li>
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
        document.querySelector(".col-lg-8").insertBefore(tag_widget,document.querySelector(".blog-lists") );

        navbar.addEventListener("click",() => {
            navbar.classList.toggle("change");
            if(siderbar.style.width==="300px")siderbar.style.width="0px";
            else siderbar.style.width="300px";
        });

        document.querySelector("#search").addEventListener("click",() => {
            document.querySelector(".form-inline").submit();
        });
        //@yield('script')
    </script>

</html>