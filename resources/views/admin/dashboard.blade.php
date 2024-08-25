@extends('admin.layout.app')

@section('title')
    Dashboard
@endsection

@section('body')

<div class="br-mainpanel">
    <div class="pd-30">
      <h4 class="tx-gray-800 mg-b-5">Dashboard</h4>
      <p class="mg-b-0">Welcome to your amazing blog dashboard</p>
    </div><!-- d-flex -->

    <div class="br-pagebody mg-t-5 pd-x-30">
      <div class="row row-sm">
        <div class="col-sm-6 col-xl-3">
          <div class="bg-teal rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-android-contacts tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total students</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$totalStudents}}</p>
                <span class="tx-11 tx-roboto tx-white-6">All registered students</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
          <div class="bg-danger rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Today Posts</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$totalPosts}}</p>
                <span class="tx-11 tx-roboto tx-white-6">Pending, approved and declined</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
          <div class="bg-primary rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Blocked posts</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$blockedPosts}}</p>
                <span class="tx-11 tx-roboto tx-white-6">Posts that are blocked and not accessible</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
          <div class="bg-br-primary rounded overflow-hidden">
            <div class="pd-25 d-flex align-items-center">
              <i class="ion ion-android-bulb tx-50 lh-0 tx-white op-7"></i>
              <div class="mg-l-20">
                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Approved posts</p>
                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$approvedPosts}}</p>
                <span class="tx-11 tx-roboto tx-white-6">Posts you have approved and are accessible</span>
              </div>
            </div>
          </div>
        </div><!-- col-3 -->
      </div><!-- row -->

      <div class="row row-sm mg-t-20">
        <div class="col-8">

          <div class="card bd-0 shadow-base pd-30 mg-t-20">
            <div class="d-flex align-items-center justify-content-between mg-b-30">
              <div>
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Newly Registered Students</h6>
                <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> Last eight students registered on the system</p>
              </div>
              <a href="{{route('admin.student.index')}}" class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">See more</a>
            </div><!-- d-flex -->

            <table class="table table-valign-middle mg-b-0">
                <tbody>
                    @forelse ($latestStudents as $student)
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
                            <td class="pd-r-0-force tx-center">
                                <a href="{{route('admin.student.show', $student->id)}}" class="tx-gray-600">
                                    <i class="icon ion-eye tx-20 lh-0"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p>No students registered recently</p>
                    @endforelse
                </tbody>
            </table>
          </div><!-- card -->

        </div><!-- col-9 -->
        <div class="col-4">

          <div class="card bd-0 mg-t-20">
            <div id="carousel2" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel2" data-slide-to="0" class="active"></li>
                <li data-target="#carousel2" data-slide-to="1"></li>
                <li data-target="#carousel2" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                @forelse ($posts as $post)
                <div @class(['carousel-item', 'active' => $loop->first])>
                    <div class="bg-br-primary pd-30 ht-300 pos-relative d-flex align-items-center rounded">

                      <div class="tx-white">
                        <a href="{{route('admin.category.show', $post->category->slug)}}" class="tx-uppercase tx-11 tx-medium tx-mont tx-spacing-2 tx-white-5">{{$post->category->name}}</a>
                        <h5 class="lh-5 mg-b-20">
                            <a target="_blank" class="text-white" href="{{route('post.show', $post->slug)}}">{{$post->title}}</a>
                        </h5>
                        <nav class="nav flex-row tx-13">
                          <a href="" class="tx-white-8 hover-white pd-l-0 pd-r-5">By {{$post->user?->name}} - {{$post->created_at->diffForHumans()}} | </a>
                          <a href="" class="tx-white-8 hover-white pd-l-0 pd-r-5">{{$post->views}} views</a>
                          <a href="" class="tx-white-8 hover-white pd-x-5">{{$post->likes}} likes</a>
                        </nav>
                      </div>
                    </div><!-- d-flex -->
                  </div>
                @empty

                @endforelse
              </div><!-- carousel-inner -->
            </div><!-- carousel -->
          </div><!-- card -->

        </div><!-- col-3 -->
      </div><!-- row -->

@endsection
