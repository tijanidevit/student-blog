@extends('admin.layout.app')


@section('title')
All Posts
@endsection

@php
    use App\Enums\PostStatusEnum;
@endphp

@section('body')
<div class="br-mainpanel br-profile-page">

    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item active" href="#">All Posts</a>
        </nav>
    </div><!-- br-pageheader -->
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="tx-gray-800 mg-b-5">All Posts</h4>
                <p class="mg-b-0">List of all the post.</p>
            </div>
        </div>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <div class="table-wrapper">
                <form action="" method="get" class="row mb-4">
                    <div class="col-md-4">
                        <label for="">Search</label>
                        <input class="form-control" placeholder="Search for posts" value="{{request()->search}}" type="search" name="search">
                    </div>
                    <div class="col-md-6">
                        <label for="">Filter by date</label>
                        <div class="row">
                            <div class="col-6">
                                <input class="form-control" placeholder="From date" value="{{request()->from_date}}" type="date" name="from_date">
                            </div>
                            <div class="col-6">
                                <input class="form-control" placeholder="To date" value="{{request()->to_date}}" type="date" name="to_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn mt-4 btn-dark">Submit</button>
                    </div>
                </form>
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Post Title</th>
                            <th class="wd-15p">Added by</th>
                            <th class="wd-15p">Status</th>
                            <th class="wd-15p">Created date</th>
                            <th class="wd-25p">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                        <tr>
                            <td><a target="_blank" href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></td>
                            <td>{{$post->user?->name}}</td>
                            <td class="text text-{{$post->status_color}}">{{$post->status}}</td>
                            <td>{{$post->created_at->format('d M, Y - H:ia')}}</td>
                            <td>
                                <form action="{{route('admin.post.approve', $post->id)}}" method="POST">
                                    @csrf
                                    <button @class(['btn', 'btn-success' => $post->status !== PostStatusEnum::APPROVED->value, 'btn-danger' => $post->status ==  PostStatusEnum::APPROVED->value])>
                                        {{$post->status !== PostStatusEnum::APPROVED->value ? "Approve" : "Block" }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <p>No post added yet</p>
                        @endforelse
                    </tbody>
                </table>

                <div>
                    {{$posts->appends([
                        'search' => request()->search,
                        'from_date' => request()->from_date,
                        'to_date' => request()->to_date,
                    ])->links()}}
                </div>
            </div>
        </div><!-- br-section-wrapper -->
    </div>
@endsection
