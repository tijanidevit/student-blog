@extends('admin.layout.app')

@section('title')
New Category
@endsection

@section('body')
<div class="br-mainpanel br-profile-page">

    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item" href="{{route('admin.category.index')}}">Categories</a>
          <a class="breadcrumb-item active" href="#" active>New</a>
        </nav>
    </div><!-- br-pageheader -->
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">New Category</h4>
        <p class="mg-b-0">Add a new post category on the system.</p>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <form action="{{route('admin.category.store')}}" method="post">
                @csrf
                <div class="row mg-b-25">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-control-label">Category name: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{old('name')}}">

                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-layout-footer">
                    <button class="btn btn-info">Submit Form</button>
                    <button class="btn btn-secondary" type="reset">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection
