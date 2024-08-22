<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title') - EBlog Admin</title>

    <!-- vendor css -->

    {{-- <link rel="stylesheet" href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css"> --}}
    {{-- <link href="/admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css" integrity="sha512-JApjWRnfonFeGBY7t4yq8SWr1A6xVYEJgO/UMIYONxaR3C9GETKUg0LharbJncEzJF5Nmiv+Pr5QNulr81LjGQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <link href="/admin/lib/Ionicons/css/ionicons.css" rel="stylesheet"> --}}
    <link href="/admin/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="/admin/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="/admin/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="/admin/lib/chartist/chartist.css" rel="stylesheet">

    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="/admin/css/bracket.css">

    <style>
        .sortable-add {
            opacity: 0.4;
            background-color: #52cd58;
            border: 2px dashed #ccc;
        }
        .sortable-remove {
            opacity: 0.4;
            background-color: #cd7952;
            border: 2px dashed #ccc;
        }

    </style>
  </head>

  <body>

    @include('admin.layout.header')
    @include('admin.layout.sidebar')

        @yield('body')
        @include('admin.layout.footer')
    </div>

    @include('admin.layout.scripts')
</body>

</html>
