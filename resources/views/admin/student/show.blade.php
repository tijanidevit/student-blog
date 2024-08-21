@extends('admin.layout.app')


@section('body')
<div class="br-mainpanel br-profile-page">

    <div class="card shadow-base bd-0 rounded-0 widget-4">
      <div class="card-header ht-75">
        <div class="hidden-xs-down">
          <a href="" class="mg-r-10"><span class="tx-medium">{{$student->user->posts_count}}</span> Posts</a>
        </div>
        <div class="tx-24 hidden-xs-down">
          <a href="" class="mg-r-10"><i class="icon ion-ios-email-outline"></i></a>
          <a href=""><i class="icon ion-more"></i></a>
        </div>
      </div><!-- card-header -->
      <div class="card-body">
        <div class="card-profile-img">
          <img src="{{$student->show_image}}" alt="">
        </div><!-- card-profile-img -->
        <h4 class="tx-normal tx-roboto tx-white">{{$student->user->name}}</h4>
        <p class="mg-b-25">{{$student->user->email}}</p>

        <p class="mg-b-0 tx-24">
            <button class="btn btn-danger">Deactivate account</button>
        </p>
      </div><!-- card-body -->
    </div><!-- card -->

    <div class=" br-profile-body">
        <div class="row">
            <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-t-5 mg-b-10">Posts Added by {{$student->user->name}}</h6>
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                <div class="bd bd-gray-300 rounded table-responsive">
                    <table class="table table-hover mg-b-0">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Position</th>
                          <th>Salary</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Tiger Nixon</td>
                          <td>System Architect</td>
                          <td>$320,800</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Garrett Winters</td>
                          <td>Accountant</td>
                          <td>$170,750</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Ashton Cox</td>
                          <td>Junior Technical Author</td>
                          <td>$86,000</td>
                        </tr>
                        <tr>
                          <th scope="row">4</th>
                          <td>Cedric Kelly</td>
                          <td>Senior Javascript Developer</td>
                          <td>$433,060</td>
                        </tr>
                        <tr>
                          <th scope="row">5</th>
                          <td>Airi Satou</td>
                          <td>Accountant</td>
                          <td>$162,700</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
              </div><!-- card -->

              <div class="bg-white pd-y-12 tx-center mg-t-15 mg-xs-t-30 shadow-base rounded">
                <a href="" class="tx-gray-600 hover-info">Load more</a>
              </div>
            </div>
          </div>

  </div>
@endsection
