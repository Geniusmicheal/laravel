@extends('Userend/layout')
@section('style')
 
    <style>
        .blog-lists-section .single-blog-post {
            background: #fff;
            border-radius: 5px;
            -webkit-box-shadow: 0px 30px 90px rgba(0, 0, 0, 0.14) !important;
            box-shadow: 0px 30px 90px rgba(0, 0, 0, 0.14) !important;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .blog-lists-section .single-blog-post .post-details {
            padding: 30px;
        }

        .blog-lists-section .single-blog-post .tags li {
            display: inline-block;
            margin-right: 10px;
        }

        .blog-lists-section .single-blog-post .tags li a {
            color: #691cff;
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
            width: 150px;
            border-radius: 50px;
            height: 60px;
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
        .addNew{
            background-color: #fff;
            width: 100%;
            margin-bottom: 12px;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    @if(auth()->guard('user')->check())
        <a href="{{ route('insertNews',['id'=>$tag]) }}" class="btn addNew">Add News</a>
    @endif
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
                        <img src="{{ asset('upload/'.$contents->newsImage)  }}" alt="">
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
@endsection