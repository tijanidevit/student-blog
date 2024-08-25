@extends('layout.app')

    @section('meta')
        <x-meta
            title="Create Post - FPI student Blog"
            description="Edit your profile on FPI student Blog - The sure source of valid and useful news happening around and within the school"
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
                                <a href="#" class="last">Edit Profile</a>
                            </div>
                        </div>
                        <!-- bread crumb inner wrapper end -->
                    </div>
                </div>
            </div>
        </div>

        <section class="eblog-featured-post-area area-2 tp-section-gapTop container mb-5">
            <div class="post-comment-box mt--80">
                <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h3 class="form-title">Edit Profile</h3>
                    <p class="desc mb--40">Please provide your full details here</p>
                    <div class="form-inner inner">

                        <div class="single-input-wrapper name">
                            <label for="terms"> Matric number</label>
                            <input type="text" readonly value="{{$user->student->matric_no}}">
                        </div>


                        <div class="single-input-wrapper name">
                            <label for="terms"> Email*</label>
                            <input type="text" value="{{old('email') ?? $user->email}}" name="email" required="">
                        </div>


                        <div class="single-input-wrapper name">
                            <label for="terms"> Name*</label>
                            <input type="text" value="{{old('name') ?? $user->name}}" name="name" required="">

                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="single-input-wrapper name">
                            <label for="terms"> Image*</label>
                            <input type="file" accept="image/*" name="image">
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>


                        <div class="single-input-wrapper">
                            <label for="terms"> About*</label>
                            <textarea name="about" required="">{{old('about') ?? $user->about}}</textarea>

                            @error('about')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>


                        <div class="single-input-wrapper">
                            <button type="submit" class="subscribe-btn tp-btn btn-primary">Edit Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    @endsection
