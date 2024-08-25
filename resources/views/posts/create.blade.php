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
                                <a href="#" class="last">New Post</a>
                            </div>
                        </div>
                        <!-- bread crumb inner wrapper end -->
                    </div>
                </div>
            </div>
        </div>

        <section class="eblog-featured-post-area area-2 tp-section-gapTop container mb-5">
            <div class="post-comment-box mt--80">
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h3 class="form-title">Add a new post</h3>
                    <p class="desc mb--40">Please post only valid and meaningful contents</p>
                    <div class="form-inner inner">

                        <div class="single-input-wrapper">
                            <label for="terms"> Title*</label>
                            <input type="text" value="{{old('title')}}" name="title" required="">

                            @error('title')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="single-input-wrapper name">
                            <label for="terms"> Image*</label>
                            <input type="file" accept="image/*" name="image" required="">
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="single-input-wrapper name">
                            <label for="terms"> Category*</label>
                            <select name="category_id" id="" required>
                                <option selected disabled>Select a category</option>
                                @forelse ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="single-input-wrappe w-100">
                            <label for="">Content*</label>
                            <textarea name="content" id="tiny">{{old('content')}}</textarea>
                            @error('content')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="single-input-wrapper">
                            <label for="keywords"> Keywords*</label>
                            <input type="text" value="{{old('keywords')}}" name="keywords" required="">

                            @error('keywords')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        {{-- <div class="single-input-wrapper check">
                            <input type="checkbox" id="terms" name="terms" value="terms of use">
                            <label for="terms"> Save my name, email, and website in this browser for the next time I Comment.</label><br>
                        </div> --}}
                        <div class="single-input-wrapper">
                            <button type="submit" class="subscribe-btn tp-btn btn-primary">Add Post</button>
                        </div>
                    </div>
                </form>
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
