@extends('admin.layout.app')

@php
    use App\Enums\PostStatusEnum;
@endphp


@section('body')
<div class="br-mainpanel br-profile-page">

    <div class="card shadow-base bd-0 rounded-0 widget-4">
      <div class="card-header ht-75">
        <div class="hidden-xs-down">
          <a href="" class="mg-r-10"><span class="tx-medium">{{$student->user->posts_count}}</span> Posts</a>
        </div>
      </div><!-- card-header -->
      <div class="card-body">
        <div class="card-profile-img">
          <img src="{{$student->user?->show_image}}" alt="">
        </div><!-- card-profile-img -->
        <h4 class="tx-normal tx-roboto tx-white">{{$student->user->name}}</h4>
        <p class="mg-b-25">{{$student->user->email}}</p>

        <p class="mg-b-0 tx-24">
            {{$student->user->posts_count}} Posts
        </p>
      </div><!-- card-body -->
    </div><!-- card -->

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
