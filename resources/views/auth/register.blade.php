<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Blog and Magazine HTML Template</title>
    <link rel="shortcut icon" href="/assets/images/icon/fav.svg" type="image/x-icon">

    <link rel="stylesheet preload" href="/assets/css/plugins/fontawesome-5.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/vendor/bootstrap.min.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/vendor/swiper.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/vendor/metismenu.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/vendor/fonts.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/vendor/magnific-popup.css" as="style">
    <link rel="stylesheet preload" href="/assets/css/style.css" as="style">
</head>

<body class="home-inner">
    <!-- Start Header Area -->

    @include('layout.header')
    @include('layout.sidebar')


    <div class="eblog-breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- bread crumb inner wrapper -->
                    <div class="breadcrumb-inner text-center">
                        <div class="meta">
                            <a href="{{url('/')}}" class="prev">Home</a>
                            <img src="/assets/images/icon/chevron-right.svg" alt="">
                            <a href="#" class="last">Sign In</a>
                        </div>
                    </div>
                    <!-- bread crumb inner wrapper end -->
                </div>
            </div>
        </div>
    </div>
    <!-- rts breadcrumba area end -->
    <!-- End Breadcrumb Area -->

    <!-- Start Sign Up Area -->
    <section class="eblog-sign-up-area tp-section-gap">
        <div class="container">
            <div class="section-inner">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-8">
                        <h2 class="heading-title text-center">Sign In</h2>
                        <form action="{{route('auth.register_action')}}" method="POST">
                            @csrf
                            <div class="form-inner inner">
                                <div class="single-input-wrapper">
                                    <input type="text" value="{{old('name')}}" name="name" placeholder="Your name" required>
                                    @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="single-input-wrapper">
                                    <input type="text" value="{{old('matric_no')}}" name="matric_no" placeholder="Your matric number" required>
                                    @error('matric_no')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="single-input-wrapper">
                                    <input type="email" value="{{old('email')}}" name="email" placeholder="Your email" required>
                                    @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="single-input-wrapper">
                                    <input type="password" name="password" placeholder="Password" required>
                                    @error('password')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="single-input-wrapper check two">
                                    <div class="check-inner">
                                        <input type="checkbox" id="terms" name="terms" value="terms of use">
                                        <label for="terms"> Remember me</label><br>
                                    </div>
                                    {{-- <a href="reset-password.html" class="forgot-password">Forgot password?</a> --}}
                                </div>
                                <div class="single-input-wrapper">
                                    <button type="submit" class="subscribe-btn tp-btn btn-primary">Log in</button>
                                </div>

                            </div>
                            <div class="form-bottom-text">
                                <p class="text-center">Have no account yet? <a href="{{route('auth.register_view')}}">Sign up</a> </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Sign Up Area -->

    <!-- Start Footer Area -->
    <footer class="eblog-footer-area footer-inner " id="footer">
        <div class="eblog-footer-copyright-area">
            <div class="copyright-content">
                <p class="title">{{date('Y')}} © All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- End Footer Area -->
    <!-- End Footer Area -->

    <!-- Start Scricpt Area -->

    <!--scroll top button-->
    <button class="scroll-top-btn">
        <i class="fa-regular fa-angles-up"></i>
    </button>
    <!--scroll top button end-->

    <div id="anywhere-home"></div>

    <script src="/assets/js/vendor/jquery.min.js" defer></script>
    <script src="/assets/js/plugins/audio.js" defer></script>
    <script src="/assets/js/vendor/bootstrap.min.js" defer></script>
    <script src="/assets/js/vendor/swiper.js" defer></script>
    <script src="/assets/js/vendor/metisMenu.min.js" defer></script>
    <script src="/assets/js/plugins/audio.js" defer></script>
    <script src="/assets/js/plugins/magnific-popup.js" defer></script>
    <script src="/assets/js/plugins/contact-form.js" defer></script>
    <script src="/assets/js/plugins/resize-sensor.min.js" defer></script>
    <script src="/assets/js/plugins/theia-sticky-sidebar.min.js" defer></script>

    <!-- main js file -->
    <script src="/assets/js/main.js" defer></script>
    <!-- End Footer Area -->

</body>

</html>
