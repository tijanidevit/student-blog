@extends('admin.layout.app')

@section('title')
Top Categories
@endsection

@section('body')
<div class="br-mainpanel br-profile-page">

    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item" href="{{route('admin.category.index')}}">Categories</a>
          <a class="breadcrumb-item active" href="#">Top Categories</a>
        </nav>
    </div><!-- br-pageheader -->
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Categories</h4>
        <p class="mg-b-0">List of all the post categories added on the system.</p>
    </div>

    <div class="br-pagebody">
        <div class="br-section-wrapper">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Category</th>
                            <th class="wd-15p">Posts added</th>
                            <th class="wd-15p">Created date</th>
                            <th class="wd-25p">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->posts_count}}</td>
                            <td>{{$category->created_at->format('d M, Y')}}</td>
                            <td class="d-flex" style="gap: 1rem">
                                <a href="{{route('admin.category.show', $category->slug)}}" class="btn" title="View">
                                    <i class="icon ion-eye tx-20 lh-0"></i>
                                </a>
                                <a href="{{route('admin.category.edit', $category->slug)}}" class="btn" title="View">
                                    <i class="icon ion-android-create tx-20 lh-0"></i>
                                </a>
                                <form method='post' action="{{route('admin.category.delete', $category->slug)}}" title="Delete">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn text-danger">
                                        <i class="icon ion-android-delete tx-20 lh-0"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <p>No category added yet</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div><!-- br-section-wrapper -->
    </div>
@endsection
