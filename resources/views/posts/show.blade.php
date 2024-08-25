@extends('layout.app')

    @section('meta')
        <x-meta
            title="{{$post->title}} - FPI student Blog"
            description="{{$post->meta_description}}"
            keywords="{{$post->keywords}}, {{$post->category->name}}"
            author="{{$post->title}}"
            image="{{$post->image}}"
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
                                <a href="{{route('post.index')}}" class="prev">Posts</a>
                                <img src="/assets/images/icon/chevron-right.svg" alt="">
                                <a href="#" class="last">{{$post->title}}</a>
                            </div>
                        </div>
                        <!-- bread crumb inner wrapper end -->
                    </div>
                </div>
            </div>
        </div>

        <section class="eblog-featured-post-area area-2 tp-section-gapTop" style="transform: none;">
            <div class="container" style="transform: none;">
                <div class="section-inner" style="transform: none;">
                    <div class="row g-5 sticky-coloum-wrap" style="transform: none;">
                        <div class="col-xl-9">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif
                            <div class="left-side-post-area">
                                <div class="eblog-hero-banner">
                                    <div class="image-area">
                                        <a href="#">
                                            <img style="max-height: 600px; min-height: 600px; max-width: 600px; min-width: 600px;" src="{{$post->image}}" alt="">
                                        </a>
                                    </div>
                                    <div class="blog-content-area">
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
                                        <a href="{{route('category.show', $post->category->slug)}}" class="eblog-social">
                                            <p class="alert alert-secondary">{{$post->category->name}}</p>
                                        </a>
                                        <div>
                                            @can('update', $post)
                                                <a class="btn btn-warning" href="{{route('post.edit', $post->slug)}}">Edit Post</a>
                                                <form action="{{route('post.delete', $post->slug)}}" method="POST" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Delete Post</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                    <h2 class="heading-title">{{$post->title}}</h2>
                                    <p>
                                        {!! $post->content !!}
                                    </p>
                                    <div class="bottom-area">
                                        <div class="blog-actions">
                                            <div class="tag-area">
                                                <p>Keywords:</p>
                                                <div class="button-tag">
                                                    <ul>
                                                        <li><a href="#">{{$post->keywords}}</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="social-area">
                                                <div class="social-title">
                                                    <p>Share:</p>
                                                </div>
                                                <ul class="social-wrapper">
                                                    <li>
                                                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}">
                                                            <i class="fa fa-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_4219_1419)">
                                                                    <path d="M6.57925 4.69623L10.2219 0.461914H9.35873L6.19579 4.13851L3.66956 0.461914H0.755859L4.57601 6.02158L0.755859 10.4619H1.61911L4.95925 6.5793L7.62713 10.4619H10.5408L6.57904 4.69623H6.57925ZM5.39691 6.07056L5.00985 5.51695L1.93015 1.11175H3.25604L5.7414 4.66688L6.12846 5.2205L9.35913 9.84163H8.03324L5.39691 6.07078V6.07056Z" fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_4219_1419">
                                                                        <rect width="10" height="10" fill="white" transform="translate(0.648438 0.461914)"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M13.5156 4.51355C13.4459 4.25457 13.3094 4.01844 13.1198 3.8288C12.9301 3.63915 12.694 3.50264 12.435 3.43293C11.4813 3.1748 7.64877 3.1748 7.64877 3.1748C7.64877 3.1748 3.81627 3.1748 2.86252 3.43293C2.60353 3.50264 2.3674 3.63915 2.17776 3.8288C1.98811 4.01844 1.8516 4.25457 1.78189 4.51355C1.60381 5.48623 1.51738 6.47348 1.52377 7.46231C1.51738 8.45113 1.60381 9.43838 1.78189 10.4111C1.8516 10.67 1.98811 10.9062 2.17776 11.0958C2.3674 11.2855 2.60353 11.422 2.86252 11.4917C3.81627 11.7498 7.64877 11.7498 7.64877 11.7498C7.64877 11.7498 11.4813 11.7498 12.435 11.4917C12.694 11.422 12.9301 11.2855 13.1198 11.0958C13.3094 10.9062 13.4459 10.67 13.5156 10.4111C13.6937 9.43838 13.7801 8.45113 13.7738 7.46231C13.7801 6.47348 13.6937 5.48623 13.5156 4.51355ZM6.42377 9.29981V5.6248L9.60439 7.46231L6.42377 9.29981Z" fill="white"></path>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M7.64775 1.33691C6.22774 1.34658 4.8552 1.84936 3.76495 2.75924C2.67469 3.66912 1.93446 4.92956 1.67089 6.32493C1.40732 7.7203 1.63679 9.16391 2.32003 10.4088C3.00328 11.6537 4.09785 12.6224 5.4165 13.1494C5.32788 12.5694 5.32788 11.9794 5.4165 11.3994L6.13838 8.33691C6.02414 8.05956 5.96757 7.76184 5.97213 7.46191C5.97213 6.61316 6.4665 5.97441 7.079 5.97441C7.18996 5.97275 7.29997 5.99508 7.40149 6.03989C7.50302 6.0847 7.59365 6.15092 7.6672 6.23402C7.74074 6.31712 7.79546 6.41514 7.82759 6.52136C7.85973 6.62757 7.86852 6.73948 7.85338 6.84941C7.85338 7.37441 7.52088 8.16191 7.34588 8.88816C7.30821 9.0236 7.30373 9.16612 7.33282 9.30366C7.36191 9.44119 7.42371 9.5697 7.51298 9.67829C7.60226 9.78688 7.71639 9.87236 7.8457 9.9275C7.97502 9.98263 8.11571 10.0058 8.25588 9.99504C9.34088 9.99504 10.1809 8.84441 10.1809 7.19066C10.1918 6.85461 10.1325 6.51998 10.0069 6.20811C9.88125 5.89623 9.69199 5.61397 9.45117 5.37933C9.21036 5.14469 8.92328 4.96282 8.60825 4.84532C8.29322 4.72783 7.95716 4.67728 7.6215 4.69691C7.26314 4.68152 6.90539 4.73901 6.56989 4.86589C6.2344 4.99276 5.92813 5.1864 5.66964 5.43508C5.41115 5.68375 5.20581 5.98229 5.06604 6.31263C4.92627 6.64297 4.85499 6.99823 4.8565 7.35691C4.85164 7.8566 5.00476 8.34505 5.294 8.75254C5.31503 8.77592 5.33002 8.80409 5.33764 8.8346C5.34527 8.8651 5.34531 8.89701 5.33775 8.92754C5.28963 9.12004 5.18463 9.54004 5.16713 9.62316C5.14963 9.70629 5.07525 9.75879 4.9615 9.70629C4.19588 9.34754 3.719 8.23191 3.719 7.33066C3.719 5.40129 5.12338 3.62504 7.76588 3.62504C9.88775 3.62504 11.5415 5.13879 11.5415 7.16441C11.5415 9.27316 10.229 10.9707 8.36088 10.9707C8.08701 10.9802 7.8151 10.9212 7.56985 10.7989C7.32459 10.6767 7.11376 10.4951 6.9565 10.2707L6.57588 11.7275C6.39342 12.2937 6.13748 12.8335 5.81463 13.3332C6.40953 13.509 7.02746 13.5945 7.64775 13.5869C9.2722 13.5869 10.8301 12.9416 11.9788 11.7929C13.1274 10.6443 13.7728 9.08637 13.7728 7.46191C13.7728 5.83746 13.1274 4.27955 11.9788 3.13088C10.8301 1.98222 9.2722 1.33691 7.64775 1.33691Z" fill="white"></path>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="author-inner d-flex align-items-center mt--70">
                                            <div class="image-area">
                                                <a href="{{route('profile.index', $post->user->id)}}"><img src="{{$post->user?->image ?? '/assets/images/banner/author-2.jpg'}}" width="307" alt=""></a>
                                            </div>
                                            <div class="content-area">
                                                <a href="{{route('profile.index', $post->user->id)}}"><h3 class="heading-title">{{$post->user?->name}}</h3></a>
                                                <p class="desc">{{$post->user?->about ?? "Bio not added yet!"}}</p>
                                            </div>
                                        </div>
                                        <div class="post-comment-box mt--80">
                                            <form action="{{route('post.comment.store', $post->id)}}" method="POST">
                                                @csrf
                                                <h3 class="form-title">Add your thoughts</h3>
                                                <p class="desc mb--40">Please be polite and nice as possible</p>
                                                <div class="form-inner inner">
                                                    <div class="single-input-wrapper">
                                                        <label for="terms"> Comment*</label>
                                                        <textarea name="content" required=""></textarea>

                                                        @error('content')
                                                            <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="single-input-wrapper">
                                                        <button type="submit" class="subscribe-btn tp-btn btn-primary">Post A Comment</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div>
                                        <ul class="list-unstyled">
                                            @forelse ($post->comments as $comment)
                                            <li class="media d-flex" style="gap: 20px">
                                                <img class="mr-3" style="max-height: 120px; min-height: 120px; max-width: 120px; min-width: 120px;" src="{{$comment->creator->image}}" alt="{{$comment->creator->name}}">
                                                <div class="media-body">
                                                  <h5 class="mt-0 mb-1">{{$comment->creator->name}} - {{$comment->created_at->diffForHumans()}}</h5>
                                                  {{$comment->content}}
                                                </div>
                                              </li>
                                            @empty

                                            @endforelse
                                          </ul>

                                          {{$post->comments->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 tp-sticky-column-item" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

                        <div class="theiaStickySideba" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 1193px;"><div class="eblog-right-sidebar">
                                <div class="eblog-right-side-post popular">
                                    <p class="title">Related Posts</p>
                                    <div class="small-post">
                                        @forelse ($relatedPosts as $relatedPost)
                                                <div class="eblog-post-list-style">
                                                    <div class="image-area">
                                                        <a href="{{route('post.show', $relatedPost->slug)}}"><img src="{{$relatedPost->image}}" alt=""></a>
                                                    </div>
                                                    <div class="blog-content">
                                                        <h4 class="heading-title">
                                                            <a class="title-animation" href="{{route('post.show', $relatedPost->slug)}}">{{$relatedPost->title}}</a>
                                                        </h4>
                                                        <ul class="blog-meta">
                                                            <li>
                                                                {{$relatedPost->views}} Views
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                        @empty

                                        @endforelse

                                    </div>
                                </div>
                            </div>

                            <div class="resize-sensor" style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;"><div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;"><div style="position: absolute; left: 0px; top: 0px; transition: all; width: 471px; height: 2410px;"></div></div><div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;"><div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div></div></div></div></div>
                    </div>
                </div>
            </div>
        </section>
    @endsection



    @section('extra-scripts')
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this post? This action cannot be undone.');
        }
    </script>
    @endsection
