<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo.png') }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">

        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> -->

        <!-- <script src="https://kit.fontawesome.com/af1cb1ae49.js" crossorigin="anonymous"></script> -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/generalBack.css') }}">
        @yield('style')
    </head>
    <body>
        <div class="wrapper">
            <header class="main-header">
                <span class="logo">
                    <a href="/">
                        <span class="logo-lg text-left" style="text-align:left;">
                            <img src="{{ asset('img/logo.png') }}" alt="" class="user-image">
                            <b>views</b>
                        </span>
                    </a>
                    <div class="menu_bar">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                </span>
                <nav class="navbar">

                    <div class="flex-right">
                        <ul class="nav navbar-nav"></ul>

                        <div class="menu_bar">
                            <div class="bar1"></div>
                            <div class="bar2"></div>
                            <div class="bar3"></div>
                        </div>
                    </div>

                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="parent {{ ($active=='dashboard'?'navActive':'') }}">
                            <a href="/dashboard">
                                <i class="fa fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="parent ">
                            <a class="parentree {{ ($menu=='blog'?'subactive':'') }}">
                                <i class="fa fa-edit"></i>
                                Blog Content
                                <i class="fa {{ ($menu=='blog'?'fa-angle-down':'fa-angle-right') }} pull-right" ></i>
                            </a>
                            <ul class="sidebar-menu sub_menu" {{ ($menu=='blog' ?'style=max-height:100vh;':'') }} >
                                
                                <li class=" {{ ($active=='category'?'navActive':'') }}">
                                    <a href="{{ route('staffcategory') }}">
                                        <i class="fa fa-tags" ></i>
                                        Categories
                                    </a>
                                </li>

                                <li class=" {{ ($active=='location'?'navActive':'') }}">
                                    <a href="{{ route('stafflocation') }}">
                                        <i class="fa fa-map-marker" ></i>
                                        Locations
                                    </a>
                                </li>
                            
                            
                                <li class=" {{ ($active=='news'?'navActive':'') }}">
                                    <a href="{{ route('staffoverview') }}">
                                        <i class="fa fa-share-square-o" ></i>
                                        Core Content
                                    </a>
                                </li>

                                <li class=" {{ ($active=='role'?'navActive':'') }}">
                                    <a href="dashboard/roles">
                                        <i class="fa fa-external-link" ></i>
                                        External Content
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="parent">
                            <a href="Dashboard/setting">
                                <i class="fa fa-opencart"></i>
                                Sponsored Ads
                                <!-- <i class="fa fa-angle-right pull-right" ></i> -->
                                <i class="fa fa-angle-down pull-right" ></i>
                            </a>
                        </li>

                        <li class="parent">
                            <a href="/dashboard">
                                <i class="fa fa-users"></i>
                                Manage Users
                                <i class="fa fa-angle-right pull-right" ></i>
                            </a>
                        </li>
                        

                        <li class="parent">
                            <a  class="parentree {{ ($menu=='account'?'subactive':'') }}">
                                <i class="fa fa-user"></i>
                                My Account
                                <i class="fa {{ ($menu=='account'?'fa-angle-down':'fa-angle-right') }} pull-right" ></i>
                            </a>

                            <ul class="sidebar-menu sub_menu" {{ ($menu=='account' ?'style=max-height:100vh;':'') }} >
                                <li class="{{ ($active=='profile'?'navActive':'') }}">
                                    <a href="{{ route('staffprofile') }}">
                                        <i class="fa fa-user-circle"></i>
                                        My Profile
                                    </a>
                                </li>
                                <li class="{{ ($active=='editprofile'?'navActive':'') }}">
                                    <a href="{{ route('staffeditprofile') }}">
                                        <i class="fa fa-user-plus"></i>
                                        Edit Profile
                                    </a>
                                </li>
                                <li class="{{ ($active=='editpassword'?'navActive':'') }}">
                                    <a href="{{ route('staffeditpassword') }}">
                                        <i class="fa fa-user-times"></i>
                                        Change Password
                                    </a>
                                </li>
                                <li class="{{ ($active=='stafflog'?'navActive':'') }}">
                                    <a href="{{ route('stafflog') }}">
                                        <i class="fa fa-clock-o"></i>
                                        Account Log
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="parent" >
                            <a class="parentree {{ ($menu=='admin'?'subactive':'') }}">
                                <i class="fa fa-steam"></i>
                                Administrative
                                <i class="fa {{ ($menu=='admin'?'fa-angle-down':'fa-angle-right') }} pull-right" ></i>
                            </a>
                            <ul class="sidebar-menu sub_menu" {{ ($menu=='admin' ?'style=max-height:100vh;':'') }} >
                                <li class=" {{ ($active=='role'?'navActive':'') }}">
                                    <a href="dashboard/roles">
                                        <i class="fa fa-user-times" ></i>
                                        Role & Permission 
                                    </a>
                                </li>

                                <li class=" {{ ($active=='role'?'navActive':'') }}">
                                    <a href="dashboard/roles">
                                        <i class="fa fa-user-times" ></i>
                                        Administrator
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="parent">
                            <a class="parentree {{ ($menu=='event'?'subactive':'') }}">
                                <i class="fa fa-map-marker"></i>
                                Event
                                <i class="fa {{ ($menu=='event'?'fa-angle-down':'fa-angle-right') }} pull-right" ></i>
                            </a>

                            <ul class="sidebar-menu sub_menu" {{ ($menu=='event' ?'style=max-height:100vh;':'') }}>
                                <li class="{{ ($active=='addEvent'?'navActive':'') }}">
                                    <a href="{{ route('staffaddevent') }}">
                                        <i class="fa fa-calendar-plus-o"></i>
                                        Add Event
                                    </a>
                                </li>

                                <li class="{{ ($active=='active'?'navActive':'') }}">
                                    <a href="{{ route('staffevent')}}?type=active">
                                        <i class="fa fa-calendar-check-o"></i>
                                        Active Event
                                    </a>
                                </li>

                                <li class="{{ ($active=='deactive'?'navActive':'') }}">
                                    <a href="{{ route('staffevent')}}?type=deactive">
                                        <i class="fa fa-calendar-times-o"></i>
                                        Deactive Event
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="parent">
                            <a class="parentree {{ ($menu=='menu'?'subactive':'') }}">
                                <i class="fa fa-cogs has-text-white fa-1x fa-fw"></i>
                                Setting
                                <i class="fa {{ ($menu=='menu'?'fa-angle-down':'fa-angle-right') }} pull-right" ></i>
                            </a>
                            <ul class="sidebar-menu sub_menu" {{ ($menu=='menu' ?'style=max-height:100vh;':'') }}>
                                <li class=" {{ ($active=='assign_menu'?'navActive':'') }}">
                                    <a href="menu">
                                        <i class="fa fa-user-times" ></i>
                                        Assigned Menu
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="parent">
                            <a href="{{ route('logout') }}">
                                <i class="fa fa-power-off has-text-white fa-1x fa-fw"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </section>
            </aside>
            <div class="content-wrapper">
                <div class="content">
                    @yield('content')
                </div>
            </div>
            <footer class="main-footer">
                <span >9javiews &copy; 2019 - {{ date("Y") }}  </span>
            </footer>
        </div>
        <script>
            const navbar =document.querySelectorAll(".menu_bar");
            const siderbar =document.querySelector(".main-sidebar");
            const parent_siderbar =document.querySelector(".sidebar");
            const menu =document.querySelectorAll("a.parentree");


            window.addEventListener("resize",  () =>{
                if(window.matchMedia("screen and (max-width: 920px)").matches)siderbar.style.width="0px";
                else siderbar.removeAttribute('style');

            });


            for (let i= 0; i< navbar.length; i++) {

                navbar[i].addEventListener("click",() => {
                    this.classList.toggle("change");
                    if(siderbar.style.width==="246px")siderbar.style.width="0px";
                    else siderbar.style.width="246px";
                });
                
            }

            for (let i= 0; i< menu.length; i++) {
                menu[i].addEventListener("click",function () {
                    menu.forEach((num) => { 
                        num.classList.remove("subactive");
                        num.nextElementSibling.style.maxHeight=null;
                        num.childNodes[3].classList.remove("fa-angle-down");
                        num.childNodes[3].classList.add("fa-angle-right");
                    }); 
                    this.classList.toggle("subactive");
                    this.childNodes[3].classList.remove("fa-angle-right");
                    this.childNodes[3].classList.add("fa-angle-down");
                    if (this.nextElementSibling.style.maxHeight)
                        this.nextElementSibling.style.maxHeight= null;
                    else this.nextElementSibling.style.maxHeight = this.nextElementSibling.scrollHeight + "px";
                  

                });
            }
            parent_siderbar.addEventListener('mouseover',function(){this.style.overflow='auto';});
            parent_siderbar.addEventListener('mouseout',function(){this.style.overflow='hidden';});
            @yield('script')
        </script>
    </body>
</html>