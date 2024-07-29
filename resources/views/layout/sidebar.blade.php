<div id="side-bar" class="side-bar header-one">
    <div class="inner">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>
        <!-- inner menu area desktop start -->
        <div class="inner-main-wrapper-desk d-none d-lg-block">
            <div class="thumbnail">
                <img src="/assets/images/logo/logo-01-w.svg" alt="eblog">
            </div>
            <div class="inner-content">
                <div class="newsletter-form">
                    <div class="form-inner">
                        <div class="content">
                            <h3 class="title mb--20">Get Newsletter</h3>
                        </div>
                        <form action="#">
                            <div class="input-div">
                                <input type="email" placeholder="Your email..." required>
                            </div>
                            <button type="submit" class="subscribe-btn">Subscribe Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile menu area start -->
    <div class="mobile-menu d-block d-lg-none">
        <nav class="nav-main mainmenu-nav mt--30">
            <ul class="mainmenu" id="mobile-menu-active">


                @guest
                    <li class="menu-item">
                        <a href="{{route('auth.register_view')}}" class="main mobile-menu-link" onclick="document.getElementById('id01').style.display='inline'">Register</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('auth.login_view')}}" class="main mobile-menu-link">Login</a>
                    </li>
                @endguest

                @auth
                    @if (auth()->user()->isAdmin())
                        <li class="menu-item">
                            <a href="{{route('admin.dashboard')}}" class="main mobile-menu-link" onclick="document.getElementById('id01').style.display='inline'">Admin Dashboard</a>
                        </li>
                    @endif
                    <li class="menu-item">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="main mobile-menu-link">Logout</button>
                    </form>
                    </li>
                @endauth
                <li class="menu-item"><a class="main mobile-menu-link" href="index-two.html">Life Style</a></li>
            </ul>
        </nav>
    </div>
    <!-- mobile menu area end -->
</div>
