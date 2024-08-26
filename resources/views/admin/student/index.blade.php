@extends('admin.layout.app')


@section('title')
All Students
@endsection

@section('body')
<div class="br-mainpanel br-profile-page">

    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item active" href="#">All Students</a>
        </nav>
    </div><!-- br-pageheader -->
    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="tx-gray-800 mg-b-5">All Students</h4>
                <p class="mg-b-0">List of all the students.</p>
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
                        <input class="form-control" placeholder="Search for students" value="{{request()->search}}" type="search" name="search">
                    </div>
                    <div class="col-md-6">
                        <label for="">Filter by creation date</label>
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
                            <th class="wd-15p">Image</th>
                            <th class="wd-15p">Name</th>
                            <th class="wd-15p">Matric number</th>
                            <th class="wd-15p">Created date</th>
                            <th class="wd-25p">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                        <tr>
                            <td class="pd-l-0-force">
                                <img src="{{$student?->user->show_image}}" class="wd-40 rounded-circle" alt="{{$student->user?->name}}">
                            </td>
                            <td>
                                <h6 class="tx-inverse tx-14 mg-b-0">{{$student->user->name}}</h6>
                                <span class="tx-12">{{$student->user->email}}</span>
                            </td>
                            <td>{{$student->matric_no}}</td>
                            <td>{{$student->user->created_at->format('d M, Y')}}</td>
                            <td class="pd-r-0-force txcenter">
                                <a href="{{route('admin.student.show', $student->id)}}" class="tx-gray-600">
                                    <i class="icon ion-eye tx-30 lh-0"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p>No students registered recently</p>
                    @endforelse
                    </tbody>
                </table>

                <div>
                    {{$students->appends([
                        'search' => request()->search,
                        'from_date' => request()->from_date,
                        'to_date' => request()->to_date,
                    ])->links()}}
                </div>
            </div>
        </div><!-- br-section-wrapper -->
    </div>
@endsection
