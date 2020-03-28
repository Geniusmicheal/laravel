@extends('Userend/layout')
@section('style')
    <meta property="og:url" content="{{ route('readnews',['type'=>$content->categorys->category,'id'=>$content->slug]) }}" />
    <meta property="og:type"   content="website" />
    <meta property="og:title"         content="9javiews" />
    <meta property="og:description"   content="{{ $content->headline }}" />
    <meta property="og:image"         content="{{ asset('img/logo.png') }}" />
    <style>
        .blog-lists-section .single-blog-post {
            background: #fff;
            border-radius: 5px;
            -webkit-box-shadow: 0px 30px 90px rgba(0, 0, 0, 0.14) !important;
            box-shadow: 0px 30px 90px rgba(0, 0, 0, 0.14) !important;
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .blog-lists-section .single-blog-post:hover .post-thumb img {
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
        }
        .blog-lists-section .single-blog-post .post-thumb {overflow: hidden;}

        .blog-lists-section .single-blog-post .post-thumb .overlay-bg {
            background: rgba(0, 0, 0, 0.3);
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }
        .blog-lists-section .single-blog-post .post-thumb img {
            width: 100%;
            -webkit-transition: all 0.3s ease 0s;
            -moz-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
        }
        .blog-lists-section .single-blog-post .post-details {padding: 30px;}

        .blog-lists-section .single-blog-post .tags li {
            display: inline-block;
            margin-right: 10px;
        }
        .blog-lists-section .single-blog-post .tags li a {
            color: #691cff;
            font-weight: 600;
            font-size: 14px;
        }
        .blog-lists-section .single-blog-post h1 {margin: 10px 0px;}

        .blog-lists-section .single-blog-post .user-details img {
            width: 45px;
            border-radius: 50px;
        }

        .blog-lists-section .single-blog-post .user-details p {margin-bottom: 0px;}
        .blog-lists-section .single-blog-post .user-details .details {margin-left: 8px;}

        .overlay {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }
        .relative {position: relative;}
        .sidebar-wrap .react ul li i {
            display: block;
            margin-bottom: 5px;
        }

        .blog-lists-section .single-blog-post .user-details p {margin-bottom: 0px;}
        .blog-lists-section .single-blog-post .user-details .details {
            margin-left: 8px;
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            font-weight: 300;
        }

        .comment-wrap {
            background: #fff;
            border-radius: 5px;
            -webkit-box-shadow: 0px 30px 90px rgba(0, 0, 0, 0.14) !important;
            box-shadow: 0px 30px 90px rgba(0, 0, 0, 0.14) !important;
            overflow: hidden;
            padding: 30px;
        }
        .comment-wrap h3 {margin-bottom: 30px;}
        .comment-wrap .media {
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        .comment-wrap .media:last-child {
            border-bottom: none;
            padding-bottom: 0px;
        }

        .comment-wrap .comments {margin-bottom: 30px;}
        .comment-wrap .comments:last-child {margin-bottom: 0px;}

        .comment-wrap .black-btn {min-width: 80px !important; }
        .comment-wrap .media-body h5 {margin-bottom: 10px;}
        .card-footer ul {
            justify-content: space-between !important;
            display: flex;
        }

        .comment-wrap .form-control{
            border-radius: 16px 0px 0px 16px;
            height: 30px;
        }
        .comment-wrap .show{ 
            border: 1px solid #dadee3;
            padding: 25px 10px 5px;
            margin-top: -15px;
            height: 160px !important;
        }
        .comment-wrap .sticky,.comment-wrap .reply-widget{
            height: 0px;
            overflow: auto;
            display: flex;
            flex-wrap: wrap;
            border-radius: 3px;
            border-top: none;
            transition: 0.4s;
        }
        .comment-wrap  .input-group{
            z-index: 10;
            width: 100%;
        }
        .reply-widget p:nth-child(2), .comments .header p:nth-child(2){
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        .reply-widget.show,.media-body .card-header{
            max-height: 80px !important;
            padding: .15rem 1.25rem;
            font-size: 12px;
            border: 1px solid #dadee3;
            display: block;
        }
        .reply-widget.show{margin-bottom: -15px;}
        .media-body .card-header{border-radius: 240px;}
        .reply-widget p,.media-body .card-header p{margin: 0px;}
        .reply-widget .close{cursor: pointer;}
        .reply-widget.show p img, .media-body .card-header p img{width: 60px;}

        @media (max-width: 767px) {
            .single-blog-post .post-details h1 {font-size: 25px;} 
        }
        @media (max-width: 417px) {
            .single-blog-post .post-details h1 {font-size: 20px;}
        }

    </style>
@endsection
@section('content')
    <div class="single-blog-post">
        <div class="post-thumb relative">
            <div class="overlay overlay-bg"></div>
            <img class="img-fluid" src="{{ asset('upload/'.$content->newsImage) }}" alt="">
        </div>

        <div class="post-details">
            <ul class="tags">
                <li><a href="{{ route('newstags',['tag'=>$content->categorys->category]) }}">
                    {{ $content->categorys->category  }}
                </a></li>
                <li><a href="#">{{ $content->locations->location }}</a></li>
            </ul>

            <h1>{{ $content->headline }}</h1>
            {!! html_entity_decode($content->content) !!}
            <?php 
                if(!empty(trim($content->download_url))):
                    $url = route('download',['id'=>base64_encode($content->download_url)]);
                    $ext = pathinfo($content->download_url, PATHINFO_EXTENSION);
                    if(strtolower($ext) =='mp3'):
            ?>
                    <audio controls style="width: 100%;">
                        <source src="{{ $content->download_url }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>

                <?php endif;?>
                <a href="{{ $url }}" class="btn btn-info" style="margin: 0px auto"> 
                    <span class="spinner-grow spinner-grow-sm"></span>
                    Download {{ $ext }}
                </a>
            <?php  endif; ?>

            <div class="user-details d-flex align-items-center">
                <div class="user-img">
                    <img src="{{ asset( $source['img'] ) }}" alt="">
                </div>
                <div class="details">
                    <a href="{{ $source['url'] == ''? '' : route('userprofile',['id' => $source['url']]) }}">
                        <h4>{{ $source['username'] }}</h4>
                    </a>
                    <p>
                        <i class="fa fa-clock-o"></i>
                        {{ date_format(date_create($content->created_at),"l jS \of F Y") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <ul >
                <li id="{{ ($usercheck==1)? '': 'like' }}">
                    <i class="far fa-thumbs-up"></i>  Like
                </li>

                <li id="{{ ($usercheck==1)? '': 'unlike' }}">
                    <i class="far fa-thumbs-down"></i>  Unlike
                </li>

                <li>
                    <div class="fb-share-button" data-href="{{ route('readnews',['type'=>$content->categorys->category,'id'=>$content->slug]) }}" data-layout="button" data-size="large"></div>
                </li>

                <li>
                    <a href="https://twitter.com/intent/tweet?url={{ route('readnews',['type'=>$content->categorys->category,'id'=>$content->slug]) }}&text={{ $content->headline }}" target="_blank">
                        <i class="fab fa-twitter-square" style="color:#00aced"></i>  Tweet
                    </a>
                </li>
            </ul>
        </div>
        <div class="comment-wrap">
            <h3>Recent Comments</h3> 
            @foreach($comment as $comments)
                <div class="media comments" >
                    <div class="media-body" accessKey="{{$comments->comment_id}}">
                        <a href="{{  route('userprofile',['id' => $comments->user->username]) }}">
                            {{ $comments->user->username }}
                        </a> &nbsp; 
                        @if($comments->parent_id != NULL)
                            <div class="card-header">
                                <p>{{$comments->inner->user->username}}</p>
                                <p>
                                    @if(pathinfo($comments->inner->comment, PATHINFO_EXTENSION))
                                        <img src="{{ (strpos($comments->inner->comment, 'http') >= 0) ? $comments->inner->comment : asset('upload/user/compress/'.$comments->inner->comment) }}">
                                    @else{{$comments->inner->comment}} @endif

                                </p>
                            </div> 
                        @endif
                        @if(pathinfo($comments->comment, PATHINFO_EXTENSION))
                          <div>  <img src="{{ (strpos($comments->comment, 'http') >= 0) ? $comments->comment : asset('upload/user/compress/'.$comments->comment) }}"></div>
                        @else <p>{{ $comments->comment }}</p> @endif
                    
                        <div class="comment-buttons">
                            @if(auth()->guard('user')->check())
                                <input type="button" class="btn btn-primary" value="Reply">
                            @else
                                <a class="btn btn-primary" href="{{ route('newstags',['tag'=>'forum']) }}">
                                    Reply
                                </a>
                            @endif

                            
                        </div>
                    </div>
                </div>
            @endforeach 
            @if(auth()->guard('user')->check())
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $content->news_id }}~{{ auth()->guard('user')->user()->user_id }}~news" id="comm_id">
                    <div class="reply-widget"></div>
                    <div class="input-group">
                        <input type="text" class="form-control"  id="comment">
                        <div class="input-group-append">
                            <span class="input-group-text"  style="background: white;">
                                <i class="fas fa-sticky-note" style="color: #4285f4;"></i>
                            </span>

                            <span class="input-group-text" style="background: white;">
                                <i class="fas fa-camera" style="color: #4285f4;"></i>
                                <input type="file" id="img" style="display: none">
                            </span>
                        </div>
                    </div>
                    <div class="sticky"></div>
                @endif
        </div>
        @if($commentCount > 10)
            <div class="card-footer">{{ $comment->render() }}</div>
        @endif  
    </div>
    <div id="fb-root"></div>
@endsection
@section('script')
//<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // var likecontent =document.querySelector(".likecontent");
    // var height = document.querySelector(".likecontent").scrollHeight;
    // console.log(document.querySelector(".like").lastElementChild.classList.);
    // document.querySelector(".like").addEventListener("click", function() {
    //     var clild =this.lastElementChild;
    //     if(likecontent.style.height===height+"px"){
    //         clild.classList.remove("fa-angle-down");
    //         clild.classList.add("fa-angle-right");
    //         likecontent.style.height="0px";
            
    //     }
    //     else {
    //         clild.classList.remove("fa-angle-right");
    //         clild.classList.add("fa-angle-down");
            
    //         likecontent.style.height=height+"px";
            
    //     }
    // });
    // console.log(document.querySelector("#totalunlike").innerHTML-1);
    //@if(auth()->guard('user')->check())
    // document.querySelector(".fa-sticky-note").addEventListener( "click" , () => {
    //         document.querySelector(".sticky").classList.toggle("show");
    //     });
    @if($usercheck != 1)
        document.querySelector("#like").addEventListener( "click" , () => {
            var totallike = document.querySelector("#totallike");
            totallike.innerHTML = parseInt(totallike.innerHTML)+1;
            like(1);
        });
        document.querySelector("#unlike").addEventListener( "click" , () => {
            var totalunlike = document.querySelector("#totalunlike");
            totalunlike.innerHTML = parseInt(totalunlike.innerHTML)+1;
            like(-1);
        });
    @endif
        var reply= document.querySelectorAll("input[type=button]");
        for (let i= 0; i< reply.length; i++) {
            var comm_id = document.getElementById("comm_id").value;
            reply[i].addEventListener("click", function() {
                var reply_id = this.parentElement.parentElement.accessKey;
                var children = this.parentElement.parentElement.children;
                
                var html= `<a class="close" data-dismiss="alert" aria-label="close">&times;</a><p><b>${children[0].innerHTML}</b></p><p>${children[1].innerHTML}</p>`;
                document.querySelector(".reply-widget").innerHTML=html;

                if(document.querySelector(".reply-widget").classList.length < 3)
                    document.querySelector(".reply-widget").classList.add("card-header","show");
                document.getElementById("comm_id").value =`${comm_id}~${reply_id}`;

                document.querySelector("a[class=close]").addEventListener("click",()=>{
                    close();
                });
            });

        }
        function close(){
            var comm_id = document.getElementById("comm_id").value;
            document.querySelector(".reply-widget").classList.remove("card-header","show");
            document.getElementById("comm_id").value = comm_id.slice(0, comm_id.lastIndexOf('~'));
        }



        function like(id){
            document.querySelector("#like").id='';
            document.querySelector("#unlike").id='';
            let formData = new FormData();
            formData.append('like', id);
            formData.append('detail', document.getElementById("comm_id").value);
            formData.append('_token', document.querySelector("input[name=_token]").value);
            
            fetch("{{route('like')}}", {
                body: formData,
                method: "post"
            });

        }

        fetch('https://api.giphy.com/v1/stickers/trending?api_key=SMWUwnJKfQ6sCruofp1AbeWXDShRFU3D&limit=150&rating=G').then(data=>{
            return data.json();
        }).then(result=>{
            var sticky =result.data;
            var record ='';
            for (var i = 0; i < sticky.length; i++) {
                record+=`<img src="${sticky[i].images.fixed_height_small_still.url}" style="width: 50px; height: 50px;cursor: pointer;">`;
            }
            document.querySelector(".sticky").innerHTML = record;
            // console.log(result);
            // fixed_width_small_stil
            // sticky[i].images.downsized_large.url
            
            const stickyImg =document.querySelectorAll(".sticky img");
            for (let i= 0; i< stickyImg.length; i++) {
                stickyImg[i].addEventListener("click",function () {
                    commentMain('img',this.src);
                });
            }
        });

        document.querySelector(".fa-sticky-note").addEventListener( "click" , () => {
            document.querySelector(".sticky").classList.toggle("show");
        });

        document.getElementById("comment").addEventListener("keyup", () => {
            if (event.keyCode === 13 || event.which === 13 ) {
                commentMain('text',document.getElementById("comment").value);
                document.getElementById("comment").value='';
            }
        });

        function commentMain(id,value){
            var detail = document.getElementById("comm_id").value;
            var comment = (id=='img') ? `<img src="${value}" >` : `${value}`;
            
            if(detail.length >=10){
                close();
                var widget = document.querySelector(".reply-widget").children;
                sub_comment =`<div class="card-header"><p>${widget[1].innerHTML}</p><p>${widget[2].innerHTML}</p></div>` ;
            }else sub_comment ='';
            

            var html=`<div class="media comments" ><div class="media-body"><a href="">{{ auth()->guard('user')->user()->username }}</a> &nbsp;${sub_comment}<div>${comment}</div><div class="comment-buttons"><a class="btn btn-primary">Reply</a></div> </div></div>`;

            document.querySelector(".reply-widget").insertAdjacentHTML('beforebegin',html);
            let formData = new FormData();
            formData.append('comment', value);
            formData.append('detail',detail);
            formData.append('_token', document.querySelector("input[name=_token]").value);
            
            fetch("{{route('comment')}}", {
                body: formData,
                method: "post"
            })
        }

        

    //@endif
//<script>
@endsection
