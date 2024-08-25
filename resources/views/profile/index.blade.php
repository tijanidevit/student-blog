@extends('layout.app')

    @section('meta')
        <x-meta
            title="Create Post - FPI student Blog"
            description="Add a new post on FPI student Blog - The sure source of valid and useful news happening around and within the school"
            keywords="blog, school, news, students, the federal polytechnic Ilaro, Nigeria news, Nigeria students"
            author="Mustapha Tijani"
            canonical="{{ url()->current() }}"
        />
    @endsection

    @section('body')
        <div class="eblog-breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- bread crumb inner wrapper -->
                        <div class="breadcrumb-inner text-center">
                            <div class="meta">
                                <a href="{{url('/')}}" class="prev">Home</a>
                                <img src="/assets/images/icon/chevron-right.svg" alt="">
                                <a href="#" class="last">Profile</a>
                                <img src="/assets/images/icon/chevron-right.svg" alt="">
                                <a href="#" class="last">{{$user->name}}</a>
                            </div>
                        </div>
                        <!-- bread crumb inner wrapper end -->
                    </div>
                </div>
            </div>
        </div>

        <section class="eblog-author-area tp-section-gap2Top">
            <div class="container">
                <div class="section-inner">
                    <div class="image-area">
                        <img src="{{$user->image}}" width="307" alt="{{$user->name}}">
                    </div>
                    <div class="content-area">
                        <h3 class="heading-title">{{$user->name}}</h3>
                        <p class="desc">{{$user->about}}</p>
                        <p class="post">{{$user->posts_count}} Posts</p>

                       @if (auth()->id() == $user->id)
                        <div class="social-wrapper">
                            <a class="btn btn-warning" href="{{route('profile.edit')}}">Edit Profile</a>
                        </div>
                       @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="eblog-featured-post-area area-2 tp-section-gapTop container mb-5">
            <div class="section-inner">
                <h2>All Posts</h2>
                <div class="row g-5">
                    @forelse ($posts as $post)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="eblog-featured-news style-two small">
                                <div class="image-area">
                                    <a href="{{route('post.show', $post->slug)}}">
                                        <img src="{{$post->image}}" alt="{{$post->title}}" style="max-height: 240px; min-height: 240px; max-width: 240px; min-width: 240px;">
                                    </a>
                                </div>
                                <div class="blog-content text-left">
                                    <a href="{{route('category.show', $post->category->slug)}}" class="tag mb--15">
                                        {{$post->category->name}}
                                    </a>
                                    <h4 class="heading-title ml--0 mb--10 text-start">
                                        <a class="title-animation text-center" href="{{route('post.show', $post->slug)}}">{{$post->title}}</a>
                                    </h4>
                                    <ul class="blog-meta justify-content-start m--0">
                                        <li class="author"><span>BY</span>{{$post->user->name}} - {{$post->created_at->format('d M, Y')}} </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>


                <div class="d-flex justify-content-end mt-5">
                    {{$posts->links()}}
                </div>
            </div>
        </section>
    @endsection


    @section('extra-scripts')

    <script src="https://cdn.tiny.cloud/1/082qv9v5v2e8fdurjssiy8ni2kfck2tuh3pf61s0efyu9v50/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#tiny',
            plugins: [
            'a11ychecker','advlist','advcode','advtable','autolink','checklist','markdown',
            'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
            'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
            'bullist numlist checklist outdent indent | removeformat | code table help'
        })
      </script>
    @endsection
