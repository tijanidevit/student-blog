<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet preload" href="/assets/css/plugins/fontawesome-5.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/vendor/bootstrap.min.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/vendor/swiper.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/vendor/metismenu.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/vendor/fonts.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/vendor/magnific-popup.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/style.css" as="style">
    @yield('meta')
</head>

<body class="home-one">

    @include('layout.header')
    @include('layout.sidebar')

    @yield('body')

    @include('layout.footer')
    @include('layout.scripts')
</body>

</html>
