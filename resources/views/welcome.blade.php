@extends('layout.app')

    @section('meta')
        <x-meta
            title="FPI student Blog"
            description="The sure source of valid and useful news happening around and within the school"
            keywords="blog, school, news, students, the federal polytechnic Ilaro, Nigeria news, Nigeria students"
            author="Mustapha Tijani"
            canonical="{{ url()->current() }}"
        />
    @endsection

    @section('body')
    <section class="eblog-banner-area">
        <div class="banner-inner">
            <div class="swiper tp-bannerSlider">
                <div class="swiper-wrapper">
                    @forelse ($sliderPosts as $post)
                    <div class="swiper-slide">
                        <div class="banner-single banner-bg" style="background-image:url({{$post->image}})">
                            <div class="container">
                                <div class="banner-content blog-content">
                                    <a href="{{route('category.show', $post->category->slug)}}" class="sub-title">{{$post->category?->name}}</a>
                                    <h2 class="heading-title">
                                        <a class="title-animation" href="{{route('post.show',$post->slug)}}">
                                            {{strlen($post->title) > 50 ? substr($post->title, 0, 50) . '...' : $post->title}}
                                        </a>
                                    </h2>
                                    <ul class="blog-meta">
                                        <li class="author">
                                            <span>BY</span>
                                            {{$post->user?->name}} - {{$post->created_at->format('d M, Y')}}
                                        </li>
                                        <li>
                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect y="4.17773" width="1.85714" height="8.35714" fill="#1E1E1E"></rect>
                                                <rect x="11.1426" y="6.96387" width="1.85714" height="5.57143" fill="#1E1E1E"></rect>
                                                <rect x="5.57227" y="0.463867" width="1.85714" height="12.0714" fill="#1E1E1E"></rect>
                                            </svg>
                                            {{$post->views}} views
                                        </li>
                                        <li>
                                            <i class="fa fa-thumbs-up"></i>
                                            {{$post->likes}} likes
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- End Banner Area -->


    <!-- Start Feature Post Area -->
    <section class="eblog-featured-post-area tp-section-gapBottom tp-section-gapTop">
        <div class="container">
            <div class="section-inner">
                <div class="row g-5 sticky-coloum-wrap">
                    <div class="col-xl-9">
                        <div class="left-side-post-area">

                            @forelse ($topCategories as $topCategory)
                            @php
                                $category = $topCategory->category
                            @endphp
                            <div class="featured-post technology tp-section-gapBottom">
                                <div class="section-title-area">
                                    <h3 class="section-title">{{$category->name}}</h3>
                                </div>
                                <div class="post-section-inner">
                                    @php
                                        $posts = $category->posts;
                                        $firstPost = $posts->first();
                                    @endphp

                                    @if (!$posts->isEmpty())
                                        <div class="big-post">
                                            <div class="eblog-featured-news">
                                                <div class="image-area">
                                                    <a href="{{route('post.show', $firstPost->slug)}}"><img src="{{$firstPost->image}}" width="533" alt=""></a>
                                                    <a href="{{route('category.show', $firstPost->category->slug)}}" class="tag">{{$post->category?->name}}</a>
                                                    <div class="blog-content">
                                                        <h4 class="heading-title"><a class="title-animation" href="{{route('post.show', $firstPost->slug)}}">{{$firstPost->title}}</a></h4>
                                                        <ul class="blog-meta">
                                                            <li class="author">
                                                                <span>BY</span>
                                                                {{$post->user?->name}} - {{$post->created_at->format('d M, Y')}}
                                                            </li>
                                                            <li>
                                                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect y="4.17773" width="1.85714" height="8.35714" fill="#1E1E1E"></rect>
                                                                    <rect x="11.1426" y="6.96387" width="1.85714" height="5.57143" fill="#1E1E1E"></rect>
                                                                    <rect x="5.57227" y="0.463867" width="1.85714" height="12.0714" fill="#1E1E1E"></rect>
                                                                </svg>
                                                                {{$post->views}} views
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-thumbs-up"></i>
                                                                {{$post->likes}} likes
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="small-post">
                                            @forelse ($posts->skip(1)->take(4) as $post)

                                                <div class="eblog-post-list-style">
                                                    <div class="image-area">
                                                        <a href="{{route('post.show', $post->slug)}}">
                                                            <img style="min-height: 120px; max-height: 120px; min-width: 120px; max-width: 120px;" src="{{$post->image}}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="blog-content">
                                                        <a href="{{route('category.show', $category->slug)}}" class="sub-title">{{$post->category?->name}}</a>
                                                        <h4 class="heading-title"><a class="title-animation" href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></h4>
                                                        <ul class="blog-meta">
                                                            <li class="author">
                                                                <span>BY</span>
                                                                {{$post->user?->name}}
                                                            </li>
                                                            <li>
                                                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect y="4.17773" width="1.85714" height="8.35714" fill="#1E1E1E"></rect>
                                                                    <rect x="11.1426" y="6.96387" width="1.85714" height="5.57143" fill="#1E1E1E"></rect>
                                                                    <rect x="5.57227" y="0.463867" width="1.85714" height="12.0714" fill="#1E1E1E"></rect>
                                                                </svg>
                                                                {{$post->views}} views
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-thumbs-up"></i>
                                                                {{$post->likes}} likes
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse

                                        </div>
                                    @else

                                    @endif
                                </div>
                            </div>
                            @empty

                            @endforelse



                            <div class="featured-post latest-news">
                                <div class="section-title-area">
                                    <h3 class="section-title">Latest News</h3>
                                </div>
                                <div class="small-post latest-news">
                                    @forelse ($latestPosts as $post)
                                    <div class="eblog-post-list-style">
                                        <div class="image-area">
                                            <a href="{{route('post.show', $post->slug)}}"><img src="{{$post->image}}" alt=""></a>
                                        </div>
                                        <div class="blog-content">
                                            <a href="{{route('category.show', $post->category->slug)}}" class="sub-title">{{$post->category?->name}}</a>
                                            <h4 class="heading-title"><a class="title-animation" href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></h4>

                                            <p class="desc">{{$post->excerpt}}</p>

                                            <ul class="blog-meta">
                                                <li class="author">
                                                    <span>BY</span>
                                                    {{$post->user?->name}} - {{$post->created_at->format('d M, Y')}}
                                                </li>
                                                <li>
                                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect y="4.17773" width="1.85714" height="8.35714" fill="#1E1E1E"></rect>
                                                        <rect x="11.1426" y="6.96387" width="1.85714" height="5.57143" fill="#1E1E1E"></rect>
                                                        <rect x="5.57227" y="0.463867" width="1.85714" height="12.0714" fill="#1E1E1E"></rect>
                                                    </svg>
                                                    {{$post->views}} views
                                                </li>
                                                <li>
                                                    <i class="fa fa-thumbs-up"></i>
                                                    {{$post->likes}} likes
                                                </li>
                                            </ul>

                                            <a href="{{route('post.show', $post->slug)}}" class="read-more-btn">Read More</a>
                                        </div>
                                    </div>
                                    @empty

                                    @endforelse
                                </div>
                                <div class="button-area">
                                    <a href="{{route('post.index')}}" class="tp-btn btn-primary">Load More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 tp-sticky-column-item">
                        <div class="eblog-right-sidebar">
                            <div class="eblog-right-side-post category">
                                <p class="title">Browse Categories</p>
                                <div class="category-area">
                                    <ul class="category-wrapper">
                                        @forelse ($categories as $category)
                                        <li>
                                            <div class="image-area">
                                                <a href="{{route('category.show', $category->slug)}}"><img src="/assets/images/category/category-01.jpg" alt=""></a>
                                                <p class="text">
                                                    <a href="{{route('category.show', $category->slug)}}">
                                                        {{$category->name}}
                                                    </a>
                                                </p>
                                            </div>
                                        </li>
                                        @empty

                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    <!-- End Feature Post Area -->

    <!-- Start Footer Area -->

    <!-- End Footer Area -->
